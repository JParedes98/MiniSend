<template>
    <div>
        <div class="sidebar" id="sidebar">
            <router-link to="/">
                <img src="/images/logo.svg" />
            </router-link>

            <div class="my-4 text-center">
                <h4 class="m-0 p-0">
                    {{ user.name }}
                </h4>
                <span class="admin-link">
                    {{ user.email }}
                </span>

                <br>
            </div>

            <ul>
                <router-link to="/templates" tag="li">
                    <a href="#">
                        <i class="far fa-copy"></i>
                        &nbsp;TEMPLATES&nbsp;
                    </a>
                </router-link>

                <router-link to="/emails" tag="li" v-b-toggle.emails_menu>
                    <a href="#">
                        <i class="fas fa-envelope-open-text"></i>
                        &nbsp;EMAILS&nbsp;
                        <i class="fas fa-arrow-circle-down float-right" style="margin-top:5px; margin-right:10px;"></i>
                    </a>
                </router-link>

                <b-collapse id="emails_menu">
                    <ul class="dropdown_menu">
                        <li class="">
                            <a href="#">
                                <i class="fas fa-inbox"></i>
                                &nbsp;INBOX
                            </a>
                        </li>

                        <li class="">
                            <a href="#">
                                <i class="fas fa-paper-plane"></i>
                                &nbsp;SENT
                            </a>
                        </li>
                    </ul>
                </b-collapse>

                <router-link to="/contacts" tag="li">
                    <a href="#">
                        <i class="fas fa-users"></i>
                        &nbsp;CONTACTS
                    </a>
                </router-link>

                <router-link to="/search" tag="li">
                    <a href="#">
                        <i class="fas fa-search"></i>
                        &nbsp;SEARCH IN DATABASE
                    </a>
                </router-link>

                <hr class="divider">

                <li tag="li">
                    <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-door-closed"></i>
                        &nbsp;LOGOUT&nbsp;
                    </a>
                </li>
            </ul>

        </div>

        <div class="show-mobile open-mobile-sidebar" onclick="toggleSidebar()">
            <span>☰</span>
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