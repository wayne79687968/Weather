<template>
    <div>
        <div class="row justify-content-center" v-if="weather.length == 0">
            <div class="spinner-border justify-content-center" role="status"></div>
        </div>
        <div class="container pb-5" v-else>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-4">
                                    <img class="card-img-top" :src="pic" alt="Card image cap">
                                </div>
                                <div style="align-self: center">
                                    <h5 class="card-title">{{ weather.location }}</h5>
                                    <p class="card-text">The weather today is <b>{{ description }}.</b></p>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li v-for="(item, key) in weather" class="list-group-item" v-show="key !== 'location'">
                                    {{ key }}: {{ item }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                lat: 0,
                lon: 0,
                weather: [],
                pic: null,
                description: null,
            }
        },
        mounted() {
            navigator.geolocation.getCurrentPosition(this.success, this.error)
        },
        methods: {
            success(position) {
                this.lat = position.coords.latitude;
                this.lon = position.coords.longitude;
                axios.get('/getWeatherData?lat=' + this.lat + '&lon=' + this.lon)
                    .then(res => {
                        const { img, description, data } = res.data;
                        this.pic = img;
                        this.description = description;
                        this.weather = data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            error(err) {
                console.log(err);
            },
        }
    }
</script>
