<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'templates'"></toolbar>

            <h1>TEMPLATES</h1>

            <code>
                {{ templates }}
            </code>
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