<template>
    <section class="container">


        <div v-if="results">
            <div class="row">
                <div class="col-6 card_apt">
                    <img :src="results.uploaded_image ? '/storage/' + results.uploaded_image : results.picture" class="card-img-top" :alt="results.title">
                </div>
                <div class="col-5 card_apt">
                    <h1>{{ slug }}</h1>
                    <div>City: {{ results.city }}</div>
                    <div>Address: {{ results.address }} N. {{ results.apartment_number }}</div>
                    <div>Rooms: {{ results.n_rooms }}</div>
                    <div> Beds: {{ results.n_beds }}</div>
                    <font-awesome-icon icon="fa-solid fa-house" />
                    <div>Bathrooms: {{ results.n_bathrooms }}</div>
                    <div>Square Meters: {{ results.square_meters }}</div>
                    <div>Services:
                        <ul>
                            <li v-for="service in results.services" :key="service.id">
                                {{ service.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <Map :address="results.address" :longitude="results.longitude" :latitude="results.latitude" />
            </div>
        </div>
        <!-- <div v-else-if="!results">
            <Page404/>
        </div> -->
        <div v-else>
            <img class="d-flex m-auto" src="https://media.tenor.com/OTzJy4d4xGMAAAAC/computer-stick-man.gif" alt="gif">
        </div>
    </section>
</template>

<script>
// import Page404 from './Page404.vue';
import Map from "../components/Map";

export default ({
    data() {
        return {
            results: null,
            urlApi: ('http://localhost:8000/api/apartments/' + this.slug),
        };
    },

    components: {
        // Page404,
        Map,
    },

    created() {
        axios.get(this.urlApi).then((axiosResponse) => {
            if (axiosResponse.data.success) {
                this.results = axiosResponse.data.results;
                console.log(this.results);
            }
        });

    },

    props: [
        'slug',
    ],
})
</script>

<style lang="scss" scoped>

@import url('https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap');

* {
    font-family: 'Bree Serif', serif;
}

.container {
    margin-top: 100px;
}
.card_apt {
    font-weight: 500;
    font-size: 17px;
}

.card-img-top {
    border-radius: 5px;
}

.row>* {
    padding-left: 0;
    padding-right: 0;
    padding-top: 30px;
    padding-bottom: 30px;
}

.row {
    display: flex;
    justify-content: center;
    gap: 10px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    background-color: white;
    border-radius: 17px;
}

h1 {
    color: brown;
    font-size: 40px;
}

#map {
    width: 800px;
    height: 380px;
}
</style>
