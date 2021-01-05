<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'templates'"></toolbar>

            <div class="row justify-content-center text-primary mt-5">
                <div class="col-md-8 col-sm-12">
                    <h1 class="font-weight-bold">Edit Template</h1>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente labore itaque dolorem dignissimos culpa!.</p>
                </div>
            </div>

            <div class="row justify-content-center align-items-center mb-3">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label class="text-muted font-weight-bold" for="template.name">Template Name</label>
                        <input type="text" class="form-control"  :class="{ 'is-invalid': validation.hasError('template.name')}" id="template.name" v-model="template.name" placeholder="Ex: My First Email Template">
                        <div class="text-danger font-weight-bold">{{ validation.firstError('template.name') }}</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <b-button pill variant="primary" @click="UpdateTemplate()" class="d-block ml-auto">UPDATE TEMPLATE</b-button>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-sm-12">
                    <label class="font-weight-bold text-muted" for="template.content">Email HTML</label>
                    <div class="text-danger font-weight-bold">{{ validation.firstError('template.content') }}</div>
                    <TemplateEditor
                        :class="{ 'is-invalid': validation.hasError('template.content')}"
                        v-model="template.content"
                        api-key="localhost" :init="{
                        menubar: true,
                        height: 400,
                        images_upload_url: '',
                        plugins: [
                            'autoresize advlist autolink lists image charmap print',
                            'searchreplace',
                            'media table paste code wordcount'
                        ],
                        toolbar:
                            'undo redo | formatselect | bold italic underline | forecolor backcolor | \
                            alignleft aligncenter alignright alignjustify | \
                            bullist numlist outdent indent',
                    }"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Editor from '@tinymce/tinymce-vue';
    import SimpleVueValidation from 'simple-vue-validator';
    const Validator = SimpleVueValidation.Validator;
    Vue.use(SimpleVueValidation);

    export default {
        components: {
            'TemplateEditor': Editor
        },

        data() {
            return {
                template: [],
            }
        },

        created() {
            this.GetTemplate();
        },

        validators: {
            'template.name': function (value) {
                return Validator.value(value)
                    .required()
                    .minLength(5)
                    .maxLength(100);
            },
            'template.content': function (value) {
                return Validator.value(value)
                    .required()
                    .minLength(10);
            },
        },

        methods: {
            GetTemplate() {
                var template_id = this.$route.params.template_id;

                axios.get(`/api/templates/GetTemplate/${template_id}`)
                    .then(res => {
                        this.template = res.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            async UpdateTemplate() {
                            var validation = await this.$validate();

                if(validation) {
                    var template = {
                        template_id: this.template.id,
                        name: this.template.name,
                        content: this.template.content
                    }

                    axios.put('/api/templates/UpdateTemplate', template)
                        .then(res => {
                            if (res.status == 200) {
                                Vue.swal({
                                    icon: 'success',
                                    title: '¡Great!',
                                    text: 'Template Created Successfully.',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                this.$router.push({ name: 'templates' });
                            }
                        })
                        .catch(function (error) {
                            Vue.swal({
                                icon: 'error',
                                title: 'Ups!',
                                text: 'Looks Something went wrong, please reload this tab.',
                                toast: true,
                                showConfirmButton: false,
                                position: 'bottom-end',
                                timer: 3000
                            });
                            console.log(error);
                        });

                }
            }
        }
    }
</script>