<template>
<div class="row toolbar">
    <div class="col-sm-12 text-center col-md-6 text-md-left">
        <h3 class="title" v-show="page == 'home'">
            WELCOME TO
            <span>
                MINISEND
            </span>
        </h3>

        <h3 class="title" v-show="page == 'templates'">
            ADMIN
            <span>
                TEMPLATES
            </span>
        </h3>

        <h3 class="title" v-show="page == 'emails'">
            ADMIN
            <span>
                EMAIL ACTIVITIES
            </span>
        </h3>

        <h3 class="title" v-show="page == 'contacts'">
            ADMIN
            <span>
                CONTACTS
            </span>
        </h3>
    </div>

    <div class="col-sm-12 text-center col-md-6 text-md-right user-profile">
        <span style="font-size:18px; vertical-align:middle;">
            <a href="#" v-b-tooltip.hover :title="user.email">
                {{ user.name }}
            </a>
        </span>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    'name': $("meta[name=logged-in-user-name]").attr('content'),
                    'email': $("meta[name=logged-in-user-email]").attr('content')
                },
            }
        },

        props: [
            'page'
        ],
    }
</script>