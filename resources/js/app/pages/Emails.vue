<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'emails'"></toolbar>

            <div class="row mt-4" v-if="emails.length > 0">
                <div class="col-md-4 my-2">
                    <div class="card card-body mb-3">
                        <div class="d-flex justify-content-between align-items-center" style="font-size: 1.2rem;">
                            <span><strong>My Emails Feed</strong></span>
                            <router-link to="/email/create" tag="span" class="text-primary" style="cursor:pointer;">
                                <i class="fas fa-edit"></i>
                            </router-link>
                        </div>
                    </div>

                    <div class="emails-box">
                        <div class="card card-body" @click="selected_email = email" v-for="email in emails" :key="email.id">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong class="d-block" v-if="email.subject">
                                        Subject: <span class="text-muted">{{ email.subject }}</span>
                                    </strong>
                                    <strong class="d-block text-muted" v-else>No Subject</strong>
                                    <br>

                                    <strong class="d-block">
                                        <span>{{ email.sender.name }}</span>
                                        <small class="text-muted">{{ email.sender.email }}</small>
                                    </strong>

                                    <strong class="d-block">
                                        To: <span class="text-muted">{{ email.recipient.email }}</span>
                                    </strong>
                                </div>
                                <div class="text-right">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 my-2">
                    <ShowEmail :email="selected_email"></ShowEmail>
                </div>
            </div>

            <div class="row empty-message" v-else>
                <div class="col-md-12">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>
                        Upsss!
                    </h4>
                    <p>No Emails Found.<br>Do you want to Send one?</p>
                    <b-button to="/email/create" pill variant="outline-primary">
                        <span class="fas fa-plus"></span>&nbsp;NEW EMAIL
                    </b-button>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import ShowEmail from "./Emails/ShowEmail";

    export default {
        components: {
            'ShowEmail': ShowEmail
        },

        data() {
            return {
                selected_email: '',
                emails: [],
            }
        },

        created() {
            this.GetAllMyEmails();
        },

        methods: {
            GetAllMyEmails() {
                axios.get('/api/emails/GetAllMyEmails')
                    .then(res => {
                        this.emails = res.data;
                        this.selected_email = this.emails[0];
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }
</script>
