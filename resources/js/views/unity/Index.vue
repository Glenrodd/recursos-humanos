<template>
    <v-card>
        <v-card-title>
            <h3>Unidades</h3>
        <v-spacer></v-spacer>
        <v-btn @click="create();" color="primary" dark class="mb-2">Nuevo</v-btn>
        </v-card-title>
        <v-card-text>
             <vue-bootstrap4-table :rows="unities" :columns="columns" :config="config" >
                <template slot="sort-asc-icon">
                    <i class="fa fa-sort-asc"></i>
                </template>
                <template slot="sort-desc-icon">
                    <i class="fa fa-sort-desc"></i>
                </template>
                <template slot="no-sort-icon">
                    <i class="fa fa-sort"></i>
                </template>
                <!-- <template slot="active" slot-scope="props">
                   <div class="text-xs-center">
                    <v-chip :color="props.row.active?'success':'danger'" :text-color="props.row.active?'white':'danger'" small>{{props.row.active?'Activo':'Inactivo'}}</v-chip>
                    </div>
                </template> -->
                <template slot="option" slot-scope="props">
                    <!-- <v-icon  small>
                        remove_red_eye
                    </v-icon> -->
                    <v-icon @click="edit(props.row)" >
                        edit
                    </v-icon>
                    <v-icon @click="destroy(props.row)" >
                        delete
                    </v-icon>
                </template>
            </vue-bootstrap4-table>
        </v-card-text>
        <edit-unity :dialog="dialog" :unity="unity" @close="close"  @unity="update"></edit-unity>

    </v-card>
</template>
<script>
import VueBootstrap4Table from 'vue-bootstrap4-table';
import EditUnity from './Edit.vue';
export default {
    data:()=>({
        unities:[],
        unity:{},
        dialog:false,
        columns: [
            {
                label: "Codigo",
                name: "id",
                filter: {
                    type: "simple",
                    placeholder: "Ingrese Codigo"
                },
                sort: true,
            },
            {
                label: "Nombre",
                name: "name",
                filter: {
                    type: "simple",
                    placeholder: "Ingrese Nombre"
                },
                sort: true,
            },

            {
                label: "Opciones",
                name: "option",
                sort: false,
            }],

        config: {
            checkbox_rows: false,
            rows_selectable: false,
            pagination: true,
            card_mode: false,
            show_refresh_button:  false,
            show_reset_button:  false,
            global_search:  {
                placeholder:  "Enter custom Search text",
                visibility:  false,
                case_sensitive:  false
            },
            per_page_options:  [5,  10,  20,  30],
            server_mode:  false,
        },


    }),
    mounted(){
        this.search();
    },
    methods:{
        search(){
            axios.get('/api/auth/unity')
                 .then((response)=>{
                    // this.employees = response.data;
                    this.unities = response.data;
                    // console.log(response.data);
                });
        },
        create() {
            this.unity ={};
            this.dialog = true;
        },

        edit (item) {

            axios.get(`/api/auth/unity/${item.id}/edit`)
            .then(response => {
                this.unity = response.data.unity
            })
            .catch(error => {
                console.log(error);
            });

            this.dialog = true
        },
        update (item) {
            console.log(item);
            axios.post('/api/auth/unity', item)
                  .then(response => {
                        iziToast.success({
                            title: 'Registro Satisfactorio',
                            message: 'Se registro '+response.data.name,
                        });
                        this.search();
                    })
                    .catch( (error) => {

                        iziToast.error({
                            title: 'Error',
                            message: 'Contactese con el Administrador de la Pagina: '+error,
                        });
                    });
            this.dialog =false;

        },
        destroy (item) {

            axios.delete(`/api/auth/unity/${item.id}`)
            .then((response)=>{

                this.search();
                iziToast.success({
                    title: 'Eliminacion Correcta',
                    message: 'Se elimino '+response.data.name,
                });
            })
            .catch( (error)=> {
                iziToast.error({
                    title: 'Error',
                    message: 'Contactese con el Administrador de la Pagina: '+error,
                });
            });
        },

        close() {
            this.dialog = false;
        }
    },
    components: {
        VueBootstrap4Table,
        EditUnity
    }
}
</script>
