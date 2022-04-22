<template>
    <div>
        <div class="form-inline">
            <div class="form-group">
                <input v-model="account" class="form-control" placeholder="搜尋帳號" @keyup.enter="searchWeatherLog">
                <button class="btn btn-primary ml-2" v-on:click="searchWeatherLog">搜尋</button>
            </div>
        </div>
        <p></p>
        <table
            class="table table-hover"
            id="table"
            data-page-list="[1, 5, 10, All]"
            data-pagination="true"
            data-page-size="2">
            <tr>
                <th>Account</th>
                <th>GPS</th>
                <th>Content</th>
                <th>Time</th>
            </tr>
            <tr v-for="log in logs">
                <td>{{ log.account }}</td>
                <td>{{ log.gps }}</td>
                <td>{{ log.content }}</td>
                <td>{{ log.created_at }}</td>
            </tr>
        </table>

        <div class="center-block text-center">
            <ul class="pagination justify-content-center">
                <li class="page-item" v-bind:class="{'disabled': (current_page === 1)}" @click.prevent="setPage(current_page - 1)"><a class="page-link" href="">Prev</a></li>
                <li class="page-item" v-for="n in last_page" v-bind:class="{'active': (current_page === (n))}" @click.prevent="setPage(n)"><a class="page-link" href="">{{n}}</a></li>
                <li class="page-item" v-bind:class="{'disabled': (current_page === last_page)}" @click.prevent="setPage(current_page + 1)"><a class="page-link" href="">Next</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                current_page: 1,
                last_page: 1,
                logs: [],
                account: '',
                page_loading: false
            }
        },
        mounted() {
            this.searchWeatherLog();
        },
        computed: {
            pageStart() {
                return (this.current_page - 1) * this.per_page;
            },
        },
        methods: {
            setPage(idx) {
                if (idx <= 0 || idx > this.last_page) {
                    return;
                }
                this.current_page = idx;
                this.searchWeatherLog();
            },
            searchWeatherLog() {
                axios.get('/logs/getWeatherLog?account=' + this.account + '&page=' + this.current_page)
                    .then(res => {
                        this.logs = res.data.data['logs'];
                        this.last_page = res.data.data['last_page'];
                        this.current_page = res.data.data['page'];
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
        }
    }
</script>
