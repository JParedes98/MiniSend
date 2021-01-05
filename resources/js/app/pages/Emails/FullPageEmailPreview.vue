<template>
    <div class="container">
        <div class="row" v-if="email != null">
            <div class="col-md-12 mb-5 mt-5">
                <div class="card card-body mb-3">
                    <div class="d-flex justify-content-between align-items-center" style="font-size: 1.2rem;">
                        <span v-if="email.subject">{{ email.subject }}</span>
                        <span v-else class="text-muted">No Subject</span>
                        <router-link tag="span" to='/emails' class="text-primary a" style="cursor: pointer;">
                            <i class="fas fa-arrow-left" v-b-tooltip.hover title="Back"></i>
                        </router-link>
                    </div>
                </div>
                <div class="card card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p>
                                <strong>{{ email.sender.name }}</strong>
                                <span class="text-muted">({{ email.sender.email }})</span>
                            </p>
                            <p>
                                <strong>To: {{ email.sender.email}}</strong>
                            </p>
                        </div>
                        <span>Date: December 24, 2020</span>
                    </div>

                    <br>
                    <div v-html="email.html"></div>
                </div>
            </div>
        </div>

        <div class="row empty-message" v-else>
            <div class="col-md-12">
                <i class="fas fa-exclamation-triangle"></i>
                <h4>
                    Upsss!
                </h4>
                <p>Email Not Found.</p>
                <b-button to="/emails" pill variant="outline-primary">
                    <span class="fas fa-plus"></span>&nbsp;GO BACK
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ShowEmail',

        data() {
            return {
                email: null,
            }
        },

        created() {
            this.GetEmail();
        },

        methods: {
            GetEmail() {
                var email_id = this.$route.params.email_id;

                axios.get(`/api/emails/GetEmail/${email_id}`)
                    .then(res => {
                        this.email = res.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }

</script>