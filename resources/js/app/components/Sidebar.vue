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
                <router-link to="/emails" tag="li">
                    <a href="#">
                        <i class="fas fa-envelope-open-text"></i>
                        &nbsp;MY EMAILS&nbsp;
                    </a>
                </router-link>

                <router-link to="/templates" tag="li">
                    <a href="#">
                        <i class="far fa-copy"></i>
                        &nbsp;TEMPLATES&nbsp;
                    </a>
                </router-link>

                <router-link to="/contacts" tag="li">
                    <a href="#">
                        <i class="fas fa-users"></i>
                        &nbsp;CONTACTS
                    </a>
                </router-link>

                <router-link to="/search" tag="li">
                    <a href="#">
                        <i class="fas fa-search"></i>
                        &nbsp;ALL EMAILS
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