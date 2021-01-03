<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'templates'"></toolbar>

            <div v-if="templates.length > 0">
                <h1>TEMPLATES</h1>
            </div>

            <div class="row empty-message" v-else>
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
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }
</script>