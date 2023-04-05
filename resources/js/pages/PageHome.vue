<template>
    <div class="container">
        <h1 class="text-center title fontperintro" style="font-family: 'Caveat', cursive; color: #0087CA; font-size: 5rem;">Welcome on BoolBnB</h1>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel"
            style="min-width: 400px; margin: 0 auto;">
            <div class="carousel-indicators">
                <button v-for="(apartment, index) in arrRandom" :key="apartment.id" type="button"
                    :data-bs-target="'#carouselExampleSlidesOnly'" :data-bs-slide-to="index"
                    :class="{ active: index === 0 }" :aria-label="'Slide ' + (index + 1)">
                </button>
            </div>
            <div class="carousel-inner">
                <div v-for="(apartment, index) in arrRandom" :key="apartment.id" class="carousel-item"
                    :class="{ active: index === 0 }">
                    <router-link :to="{ name: 'apartment', params: { slug: apartment.slug } }">
                        <img :src="apartment.uploaded_image ? '/storage/' + apartment.uploaded_image : apartment.picture"
                            :alt="apartment.title" class="d-block w-100" />
                    </router-link>
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ apartment.title }}</h5>
                        <p>{{ apartment.description }}</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSlidesOnly"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSlidesOnly"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div>
            <h3 class="mt-4 text-center title fontperintro" style="font-family: 'Caveat', cursive; color: #0087CA; font-size: 4rem;">Visit all
                <router-link :to="{ name: 'apartments'}">apartments
                </router-link>!!!
            </h3>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            arrRandom: null,
        }
    },
    created() {
        axios.get('/api/apartments/random')
            .then(response => this.arrRandom = response.data.results);
    }
}
</script>

<style lang="scss" scoped>

/* adjust the width of the carousel-inner class to match the width of the carousel */
.carousel-inner {
    width: 100%;
}

.title {
    font-size: 3rem;
    font-weight: 100;
    color: #ff0000;
    margin-bottom: 30px;
}
