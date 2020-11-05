<template>
    <div @click="vote($event.target)" class="d-flex flex-column text-center align-middle">
        <i class="fas fa-triangle vote-icon up-vote" data-vote="up"></i>
        <div class="vote-icon vote-text" data-vote="remove" v-html="voteCount"></div>
        <i class="fas fa-triangle fa-rotate-180 vote-icon down-vote" data-vote="down"></i>
    </div>
</template>

<script>
    export default {
        name: 'vote',
        props: ['votable'],
        data() {
            return {
                currentVote: undefined
            }
        },
        methods: {
            vote(target)
            {
                const $target = $(target)

                const vote = $target.data('vote')

                if (!vote) {
                    return
                }

                switch (vote) {
                    case 'up': this.upVote(); break
                    case 'down': this.downVote(); break
                    case 'remove': this.removeVote(); break
                }

                $target.toggleClass('selected')
            },
            upVote()
            {
                this.currentVote = 'up'
            },
            downVote()
            {
                this.currentVote = 'down'
            },
            removeVote()
            {
                this.currentVote = undefined
            },
        },
        computed: {
            voteCount()
            {
                return this.votable.votes_count == 0 ? '<i class="fas fa-circle"></i>' : this.votable.votes_count
            }
        },
    }
</script>

<style scoped>
    i.vote-icon {
        font-size: 32px;
        color: #878a8c;
        border-radius: 8px;
        padding: 0.25em;
    }

    .vote-text {
        font-size: 0.75em !important;
    }

    i.vote-icon:not(.vote-text):hover {
        background-color: #e0e2e3;
    }

    i.vote-icon.selected {
        color: #000;
    }
</style>
