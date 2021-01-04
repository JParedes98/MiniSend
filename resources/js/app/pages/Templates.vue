<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'templates'"></toolbar>

            <div v-if="providerData.length > 0">
                <div class="row justify-content-between align-items-center my-4">
                    <div class="col-md-6 col-sm-12">
                        <b-input-group size="md">
                            <b-form-input v-model="search" type="search" size="sm" placeholder="Search Template..."
                                style="max-width:250px;"></b-form-input>
                        </b-input-group>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="row justify-content-end align-items-center col-md-12 p-0 m-0">
                            <b-form-select v-model="filter" id="perPageSelect" size="sm" :options="filterOptions"
                                style="margin-right:10px;max-width:250px;">
                            </b-form-select>

                            <b-button to="/templates/create" pill variant="outline-primary">
                                <span class="fas fa-plus"></span>&nbsp;CREATE
                            </b-button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-4" v-if="templates.length > 0">
                <b-card-group columns>
                    <b-card v-for="(item, index) in templates" :key="item.id" :title="item.name">

                        <router-link :to="'/templates/update/' + item.id" class="text-primary mr-2" v-b-tooltip.hover title="Edit Template">
                            <i class="far fa-edit"></i> Edit
                        </router-link>

                        <a @click="DeleteTemplate(item, index)" class="text-danger ml-2" v-b-tooltip.hover title="Delete Template">
                            <i class="far fa-trash-alt"></i> Delete
                        </a>

                    </b-card>
                </b-card-group>
            </div>

            <div class="row empty-message" v-if="templates.length < 1">
                <div class="col-md-12">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>
                        Upsss!
                    </h4>
                    <p>No Templates Found.<br>Do you want to create one?</p>
                    <b-button to="/templates/create" pill variant="outline-primary">
                        <span class="fas fa-plus"></span>&nbsp;CREATE
                    </b-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                templates: [],
                providerData: [],
                search: '',
                filter: 0,
                filterOptions: [{ value: 0, text: 'All My Templates' },
                ],
            }
        },

        created() {
            this.GetMyTemplates();
        },

        methods: {
            GetMyTemplates() {
                axios.get('/api/templates/GetMyTemplates')
                    .then(res => {
                        this.templates = res.data;
                        this.providerData = res.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            DeleteTemplate(item, index) {
                axios.delete(`/api/templates/DeleteTemplate/${item.id}`)
                    .then(res => {
                        if(res.status == 200) {
                            this.templates.splice(index, 1);
                            this.providerData.splice(index, 1);
                            Vue.swal({
                                icon: 'success',
                                title: '¡Great!',
                                text: 'Template Removed Successfully.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },

        watch: {
            search(search) {
                if (this.search === '') {
                    this.templates = this.providerData;
                } else {
                    var results = search.toLowerCase() ? this.templates.filter(item => item.name.toLowerCase().includes(this.search)) : this.templates;
                    this.templates = results;
                }
            },

            filter() {
                switch (this.filter) {
                    case 0:
                        this.templates = this.providerData;
                        break;

                    default:
                        return this.templates;
                        break;
                }
            }
        },
    }

</script>
