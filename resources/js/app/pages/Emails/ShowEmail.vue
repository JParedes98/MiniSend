<template>
    <div>
        <div class="card card-body mb-3">
            <div class="d-flex justify-content-between align-items-center" style="font-size: 1.2rem;">
                <span v-if="email.subject">{{ email.subject }}</span>
                <span v-else class="text-muted">No Subject</span>
                <router-link tag="span" style="cursor: pointer;" :to="'/email/preview/' + email.id" class="text-primary">
                    <i class="fas fa-eye" v-b-tooltip.hover title="Preview"></i>
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

            <hr>
                <p>{{ email.text }}</p>
            <br>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ShowEmail',
        props: [
            'email'
        ],
    }

</script>