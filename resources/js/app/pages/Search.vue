<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'emails'"></toolbar>

            <div class="row justify-content-between align-items-center mt-4">
                <div class="col-md-12 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-primary font-weight-bold">ADMIN EMAILS</h4>
                    </div>
                </div>

                <div class="col-md-2 col-sm-12">
                    <b-form-input v-model="search" type="search" size="sm" placeholder="Search Email...">
                    </b-form-input>
                </div>

                <div class="col-md-4 col-sm-12">
                    <div class="row">
                        <div class="col">
                            <b-form-select v-model="filter" size="sm" :options="filterOptions">
                            </b-form-select>
                        </div>

                        <div class="col">
                            <b-form-select v-model="perPage" size="sm" :options="pageOptions">
                            </b-form-select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" v-if="emails.length > 0">
                    <div class="table-responsive">
                        <b-table id="emails_table" selectable ref="emails_table" select-mode="single"
                            @row-selected="OnRowSelected" :per-page="perPage" :current-page="currentPage"
                            :items="emails" :fields="fields" :filter="search" class="table-theme" borderless fixed
                            responsive>

                                <template v-slot:cell(created_at)="data">
                                    <span>
                                        {{ data.item.created_at | moment("MMM-DD-YYYY (HH:mm)") }}
                                    </span>
                                </template>
                        </b-table>

                        <b-pagination v-model="currentPage" :total-rows="totalEmails" :per-page="perPage"
                            aria-controls="emails_table">
                        </b-pagination>

                        <b-modal ref="show_email" hide-header hide-footer centered size="lg">
                            <ShowEmail :email="selected"></ShowEmail>
                        </b-modal>
                    </div>
                </div>

                <div class="col-md-12 text-center mt-5" v-else>
                    <i class="fas fa-exclamation-triangle text-primary" style="font-size: 5rem;"></i>
                    <h4 class="text-primary font-weight-bold my-2" style="font-size: 2rem;">
                        Upsss!
                    </h4>
                    <p style="font-size: 1.3rem;">No Emails Found.</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShowEmail from "./Emails/ShowEmail";
    import moment from 'moment';

    export default {
        components: {
            'ShowEmail': ShowEmail
        },

        data() {
            return {
                emails: [],
                providerData: [],
                selected: '',
                search: '',
                currentPage: 1,
                perPage: 10,
                pageOptions: [{
                        value: 5,
                        text: 'Show 5 Items'
                    },
                    {
                        value: 10,
                        text: 'Show 10 Items'
                    },
                    {
                        value: 25,
                        text: 'Show 25 Items'
                    },
                    {
                        value: 50,
                        text: 'Show 50 Items'
                    },
                    {
                        value: 100,
                        text: 'Show 100 Items'
                    },
                ],
                filter: 0,
                filterOptions: [ 
                    { value: 0, text: 'All My Emails' },
                    { value: 1, text: 'Posted Emails' },
                    { value: 2, text: 'Sent Emails' },
                    { value: 3, text: 'Failed Emails' },
                ],
                fields: [
                    { key: 'subject', label: 'Subject', sortable: true },
                    { key: 'recipient.email', label: 'Email To', sortable: true },
                    { key: 'sender.name', label: 'Sender', sortable: true },
                    { key: 'status', label: 'Status', sortable: true },
                    { key: 'created_at', label: 'Sent at', sortable: true },
                ],
            }
        },

        created() {
            this.GetAllMyEmails();
        },

        methods: {
            GetAllMyEmails() {
                axios.get('/api/emails/GetAllEmails')
                    .then(res => {
                        this.emails = res.data;
                        this.providerData = res.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            OnRowSelected(item) {
                this.selected = JSON.parse(JSON.stringify(item[0]));
                this.$refs['show_email'].show();
            },
        },
        computed: {
            totalEmails() {
                return this.emails.length;
            },
        },
        watch: {
            filter() {
                switch (this.filter) {
                    case 0:
                        this.emails = this.providerData;
                        break;

                    case 1:
                        this.emails = this.providerData;
                        this.emails = this.emails.filter(item => item.status == 'POSTED');
                        console.log(this.emails);
                        break;

                    case 2:
                        this.emails = this.providerData;
                        this.emails = this.emails.filter(item => item.status == 'SENT');
                        break;

                    case 3:
                        this.emails = this.providerData;
                        this.emails = this.emails.filter(item => item.status == 'FAILED');
                        break;

                    default:
                        return this.emails;
                        break;
                }
                // return this.search ? this.users.filter(item => item.title.includes(this.search) || item.visitor_name.includes(this.search) || item.student_name.includes(this.search)) : this.users
            }
        }
    }

</script>
