<template>
    <div>
        <sidebar></sidebar>

        <div class="content container-fluid">
            <toolbar :page="'contacts'"></toolbar>

            <div class="my-4 mx-2" v-if="contacts.length > 0">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md-12 mb-3">
                        <h4 class="text-primary font-weight-bold">MY CONTACTS</h4>
                    </div>

                    <div class="col-md-2 col-sm-12">
                        <b-form-input v-model="search" type="search" size="sm" placeholder="Search Contact...">
                        </b-form-input>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="row">
                            <div class="col">
                                <b-form-select v-model="filter" id="perPageSelect" size="sm" :options="filterOptions">
                                </b-form-select>
                            </div>

                            <div class="col">
                                <b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions">
                                </b-form-select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <b-table id="contacts_table" selectable ref="contacts_table" select-mode="single"
                                @row-selected="OnRowSelected" :per-page="perPage" :current-page="currentPage"
                                :items="contacts" :fields="fields" :filter="search" class="table-theme" borderless fixed
                                responsive>

                                <template v-slot:cell(actions)="data">
                                    <b-dropdown size="lg"  variant="link" toggle-class="text-decoration-none" no-caret>
                                        <template #button-content>
                                            <i class="fas fa-ellipsis-v"></i> Options
                                        </template>
                                        <b-dropdown-item @click="DetachContact(data.item.id)"><i class="far fa-trash-alt"></i> Delete</b-dropdown-item>
                                    </b-dropdown>
                                </template>
                            </b-table>

                            <b-pagination v-model="currentPage" :total-rows="totalContacts" :per-page="perPage"
                                aria-controls="contacts_table">
                            </b-pagination>

                            <b-modal ref="update_contact" hide-header hide-footer centered size="sm">
                                <form @submit.prevent="UpdateContact()">
                                    <div class="form-group">
                                        <h2 class="text-center text-muted font-weight-bold">
                                            UPDATE <span class="text-primary">CONTACT</span>
                                        </h2>
                                    </div>

                                    <div class="form-group">
                                        <label for="selected.email" class="font-weight-bold text-muted">Contact Email</label>
                                        <input type="email" id="selected.email" v-model="selected.email" class="form-control"
                                            placeholder="Ex: jparedes@gmail.com" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="selected.new" class="font-weight-bold text-muted">Update to:</label>
                                        <input type="email" id="selected.new" v-model="selected.new" class="form-control"
                                            placeholder="Ex: jparedes@gmail.com">
                                    </div>

                                    <div class="form-group">
                                        <br class="my-3">
                                        <b-button type="submit" pill block variant="outline-primary">SAVE</b-button>
                                    </div>
                                </form>
                            </b-modal>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row empty-message" v-else>
                <div class="col-md-12">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h4>
                        Upsss!
                    </h4>
                    <p>No Contacts Found.<br>Do you want to Add one?</p>
                    <b-button v-b-modal.add_contact pill variant="outline-primary">
                        <span class="fas fa-plus"></span>&nbsp;ADD CONTACT
                    </b-button>
                </div>
            </div>

            <b-modal id="add_contact" ref="add_contact" hide-header hide-footer centered size="sm">
                <form @submit.prevent="SaveContact()">
                    <div class="form-group">
                        <h2 class="text-center text-muted font-weight-bold">
                            ADD <span class="text-primary">CONTACT</span>
                        </h2>
                    </div>

                    <div class="form-group">
                        <label for="email" class="font-weight-bold text-muted">Email</label>
                        <input type="email" id="email" v-model="new_contact" class="form-control"
                            placeholder="Ex: jparedes@gmail.com">
                    </div>

                    <div class="form-group">
                        <br class="my-3">
                        <b-button type="submit" pill block variant="outline-primary">SAVE</b-button>
                    </div>
                </form>
            </b-modal>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                contacts: [],
                providerData: [],
                new_contact: '',
                selected: {
                    email: '',
                    new: ''
                },
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
                filterOptions: [ { value: 0, text: 'All My Contacts' }, ],
                fields: [
                    { key: 'actions', label: 'Opciones' },
                    { key: 'email', label: 'Contact Email', sortable: true },
                ],
            }
        },

        created() {
            this.GetMyContacts();
        },

        methods: {
            GetMyContacts() {
                axios.get('/api/contacts/GetMyContacts')
                    .then(res => {
                        this.contacts = res.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            SaveContact() {
                var formData = new FormData();
                formData.append('email', this.new_contact);

                axios.post('/api/contacts/SaveContact', formData)
                    .then(res => {
                        if (res.status == 200) {
                            this.contacts.unshift(res.data);
                            this.providerData.unshift(res.data);
                            Vue.swal({
                                icon: 'success',
                                title: '¡Great!',
                                text: 'Contact Added Successfully.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            this.new_contact = '';
                            this.$refs['add_contact'].hide();
                        }
                    })
                    .catch(function (error) {
                        if (error.response.status == 409) {
                            Vue.swal({
                                icon: 'info',
                                title: '¡Mmm!',
                                text: 'Looks this contact already has been added to your account before.',
                                toast: true,
                                showConfirmButton: false,
                                position: 'bottom-end',
                                timer: 3000
                            });
                            this.new_contact = '';
                            this.$refs['add_contact'].hide();
                        } else {
                            Vue.swal({
                                icon: 'info',
                                title: '¡Mmm!',
                                text: 'Looks Something went wrong, please reload this tab.',
                                toast: true,
                                showConfirmButton: false,
                                position: 'bottom-end',
                                timer: 3000
                            });
                        }
                        console.log(error);
                    });
            },

            UpdateContact() {
                var formData = new FormData();
                formData.append('email', this.selected.email);
                formData.append('new_email', this.selected.new);

                axios.post('/api/contacts/UpdateContact', formData)
                    .then(res => {
                        if (res.status == 200) {
                            var index = this.contacts.findIndex(contact => contact.id === this.selected.id);
                            this.contacts.splice(index, 1);
                            this.contacts.unshift(res.data);
                            this.providerData = this.contacts;
                            Vue.swal({
                                icon: 'success',
                                title: '¡Great!',
                                text: 'Contact Updated Successfully.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            this.selected = {
                                email: '',
                                new: '',
                            };
                            this.$refs['update_contact'].hide();
                        }
                    })
                    .catch(function (error) {
                        if (error.response.status == 409) {
                            Vue.swal({
                                icon: 'info',
                                title: '¡Mmm!',
                                text: 'Looks this contact already has been added to your account before.',
                                toast: true,
                                showConfirmButton: false,
                                position: 'bottom-end',
                                timer: 3000
                            });
                            this.selected = '';
                            this.$refs['update_contact'].hide();
                        } else {
                            Vue.swal({
                                icon: 'info',
                                title: '¡Mmm!',
                                text: 'Looks Something went wrong, please reload this tab.',
                                toast: true,
                                showConfirmButton: false,
                                position: 'bottom-end',
                                timer: 3000
                            });
                        }
                        console.log(error);
                    });
            },

            DetachContact(contact_id) {
                axios.delete(`/api/contacts/DetachContact/${contact_id}`)
                    .then(res => {
                        var index = this.contacts.findIndex(contact => contact.id === contact_id);
                        this.contacts.splice(index, 1);
                        this.providerData.splice(index, 1);
                        Vue.swal({
                            icon: 'success',
                            title: '¡Great!',
                            text: 'Contact Removed Successfully.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            OnRowSelected(item) {
                this.selected = JSON.parse(JSON.stringify(item[0]));
                this.$refs['update_contact'].show();
            },
        },
        computed: {
            totalContacts() {
                return this.contacts.length
            },
        },
        watch: {
            filter() {
                switch (this.filter) {
                    case 0:
                        this.contacts = this.providerData;
                        break;

                    default:
                        return this.contacts;
                        break;
                }
                // return this.search ? this.users.filter(item => item.title.includes(this.search) || item.visitor_name.includes(this.search) || item.student_name.includes(this.search)) : this.users
            }
        }
    }

</script>
