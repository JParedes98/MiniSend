<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'templates'"></toolbar>

            <div class="row justify-content-center text-primary mt-5">
                <div class="col-md-8 col-sm-12">
                    <h1 class="font-weight-bold"><i class="far fa-copy"></i> Create New Template</h1>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente labore itaque dolorem dignissimos culpa!.</p>
                </div>
            </div>

            <div class="row justify-content-center align-items-center mb-3">
                <div class="col-md-4 col-sm-6">
                    <div class="form-group">
                        <label class="text-muted font-weight-bold" for="template.name">Template Name</label>
                        <input type="text" class="form-control" id="template.name" v-model="template.name" placeholder="Ex: My First Email Template">
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <b-button pill variant="primary" @click="SaveTemplate()" class="d-block ml-auto">SAVE TEMPLATE</b-button>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-md-8 col-sm-12">
                    <TemplateEditor
                    v-model="template.content"
                        api-key="zewq41kg1hmlckq3auked6txoo916a3e4lrvp8h8a576gxyu" :init="{
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

    export default {
        components: {
            'TemplateEditor': Editor
        },

        data() {
            return {
                template: {
                    'name': '',
                    'content' :
                            `
                                <p style="text-align: center;">
                                    <img title="TinyMCE Logo" src="/images/logo.svg" alt="" width="110" height="97">
                                </p>
                                <h2 style="text-align: center;">This is a Demo Template</h2>

                                <h5 style="text-align: center;">
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo facere, debitis tenetur aliquid repellat eligendi earum.
                                </h5>

                                <h2>Got questions or need help?</h2>
                                <ul>
                                    <li>Our documentation is a great resource for learning how to configure MiniSend.</li>
                                    <li>Have a specific question? Try the MiniSend tag at Stack Overflow</li>
                                    <li>We also offer enterprise grade support as part of TinyMCE premium subscriptions</li>
                                </ul>

                                <h3>A simple table to play with</h3>
                                <table style="border-collapse: collapse; width: 100%;" border="1">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Cost</th>
                                            <th>Really?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>MiniSend</td>
                                            <td>Get started for free</td>
                                            <td>YES!</td>
                                        </tr>
                                        <tr>
                                            <td>MiniSend</td>
                                            <td>Free</td>
                                            <td>YES!</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo facere, debitis tenetur aliquid repellat eligendi earum. Quidem, in tempora, qui autem omnis ullam sint ex dolorum, reprehenderit animi a ea.</p>
                                <p>Thanks for using MiniSend!</p>
                            `
                }
            }
        },

        methods: {
            SaveTemplate() {
                var formData = new FormData();
                formData.append('name', this.template.name);
                formData.append('content', this.template.content);

                axios.post('/api/templates/SaveTemplate', formData)
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
</script>