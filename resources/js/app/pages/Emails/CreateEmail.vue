<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'emails'"></toolbar>

            <div class="row justify-content-center text-primary mt-5">
                <div class="col-md-8 col-sm-12">
                    <h1 class="font-weight-bold"><i class="fas fa-paper-plane"></i> Send Mail</h1>
                    <p class="text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente labore
                        itaque dolorem dignissimos culpa!.</p>
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label class="text-muted font-weight-bold" for="mail.sender">From</label>
                        <input type="text" class="form-control" id="mail.sender" v-model="mail.sender"
                            placeholder="Ex: jparedes@gmail.com" disabled>
                        <small>**If you set a diferent email than the one in your account, the email is goint to be sent
                            but you wont be able to follow up this email.</small>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <label class="text-muted font-weight-bold" for="mail.recipient">To</label>
                    <b-form-input type="text" :class="{ 'is-invalid': validation.hasError('mail.recipient')}"
                        id="mail.recipient" v-model="mail.recipient" list="contacts-list"
                        placeholder="Ex: jparedes@gmail.com"></b-form-input>
                    <div class="text-danger font-weight-bold">{{ validation.firstError('mail.recipient') }}</div>

                    <datalist id="contacts-list">
                        <option v-for="contact in contacts" :key="contact.id">{{ contact.email }}</option>
                    </datalist>
                </div>
            </div>

            <div class="row justify-content-center mb-5">
                <div class="col-md-4 col-sm-12">
                    <label class="text-muted font-weight-bold" for="mail.subject">Subject</label>
                    <input type="text" class="form-control"
                        :class="{ 'is-invalid': validation.hasError('mail.subject')}" id="mail.subject"
                        v-model="mail.subject" placeholder="Ex: Welcome Mail">
                    <div class="text-danger font-weight-bold">{{ validation.firstError('mail.subject') }}</div>
                </div>

                <div class="col-md-4 col-sm-12">
                    <label class="text-muted font-weight-bold" for="mail.subject">Default Template</label>
                    <input type="text" class="form-control" id="mail.subject" v-model="mail.template.name" disabled>
                </div>
            </div>

            <div class="row justify-content-center align-items-center mb-3">
                <div class="col-md-8 col-sm-12">
                    <label class="font-weight-bold text-muted" for="mail.text">Text message</label>
                    <b-form-textarea id="mail.text" v-model="mail.text"
                        :class="{ 'is-invalid': validation.hasError('mail.text')}"
                        placeholder="Type your Text Message here..." rows="3"></b-form-textarea>
                    <div class="text-danger font-weight-bold">{{ validation.firstError('mail.text') }}</div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12">
                    <div class="text-danger font-weight-bold">{{ validation.firstError('mail.template.content') }}</div>
                    <TemplateEditor v-model="mail.template.content"
                        :class="{ 'is-invalid': validation.hasError('mail.template.content')}"
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
                    }" />
                </div>
            </div>

            <div class="row justify-content-center mt-3 mb-5">
                <div class="col-md-8">
                    <b-button @click="SaveAndSendEmail()" pill variant="primary" class="float-right">SEND EMAIL
                    </b-button>
                </div>
            </div>

            <div v-if="templates.length > 0">
                <b-modal visible id="create_email" ref="create_email" hide-header hide-footer centered
                    no-close-on-backdrop no-close-on-esc size="sm">
                    <div class="form-group">
                        <h2 class="text-center text-muted font-weight-bold">
                            NEW <span class="text-primary">MAIL</span>
                        </h2>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-muted">Select Email Template</label>
                        <b-form-select v-model="mail.template">
                            <b-form-select-option :value="template" v-for="template in templates" :key="template.id">
                                {{ template.name }}</b-form-select-option>
                        </b-form-select>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-muted">Recipient</label>
                        <b-form-input type="text" v-model="mail.recipient" list="contacts"></b-form-input>

                        <datalist id="contacts">
                            <option v-for="contact in contacts" :key="contact.id">{{ contact.email }}</option>
                        </datalist>
                    </div>

                    <div class="form-group">
                        <br class="my-2">
                        <b-button @click="$bvModal.hide('create_email');" pill block variant="outline-primary">CONTINUE
                        </b-button>
                        <hr>
                        <b-button to="/emails" pill block variant="secondary">BACK</b-button>
                    </div>
                </b-modal>
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
                mail: {
                    template: '',
                    sender: $("meta[name=logged-in-user-email]").attr('content'),
                    subject: '',
                    text: '',
                    recipient: '',
                },

                templates: [],
                contacts: [],
            }
        },

        created() {
            this.GetMyTemplates();
            this.GetMyContacts();
        },

        validators: {
            'mail.subject': function (value) {
                return Validator.value(value)
                    .required()
                    .minLength(3)
                    .maxLength(250);
            },
            'mail.text': function (value) {
                return Validator.value(value)
                    .minLength(3)
                    .maxLength(250);
            },
            'mail.template.content': function (value) {
                return Validator.value(value)
                    .required()
                    .minLength(3);
            },
            'mail.recipient': function (value) {
                return Validator.value(value)
                    .required()
                    .email()
                    .minLength(3)
                    .maxLength(250);
            },
        },

        methods: {
            GetMyTemplates() {
                axios.get('/api/templates/GetMyTemplates')
                    .then(res => {
                        this.templates = res.data;
                        this.mail.template = this.templates[0];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            GetMyContacts() {
                axios.get('/api/contacts/GetMyContacts')
                    .then(res => {
                        this.contacts = res.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            async SaveAndSendEmail() {
                var validation = await this.$validate();

                if (validation) {
                    var formData = new FormData();
                    formData.append('subject', this.mail.subject);
                    formData.append('text', this.mail.text);
                    formData.append('html', this.mail.template.content);
                    formData.append('recipient', this.mail.recipient);

                    axios.post('/api/emails/SaveAndSendEmail', formData)
                        .then(res => {
                            if (res.status == 200) {
                                Vue.swal({
                                    icon: 'success',
                                    title: '¡Great!',
                                    text: 'Mail Sent Successfully.',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                this.$router.push({
                                    name: 'emails'
                                });
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
