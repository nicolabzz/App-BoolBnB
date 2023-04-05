<template>
    <section class="container">

        <h1 class="text-center title fontperintro" style="font-family: 'Caveat', cursive; color: #0087CA; font-size: 5rem;">Apartments</h1>

        <div class="form-outline w-75 m-auto">
            <input type="text" id="form12" class="form-control" placeholder="Search apartments" v-model="searchTerm" />
            <label class="form-label" for="form12"></label>
        </div>

        <div class="row g-3" v-if="results">

            <div v-for="item in filteredItems" :key="item.id" class="col-sm-6 col-md-4 apt-card">
                <div class="card h-100">
                    <img :src="item.uploaded_image ? '/storage/' + item.uploaded_image : item.picture" class="card-img-top" :alt="item.title" />

                    <div class="card-body d-flex flex-column justify-content-end">
                        <h4 class="card-title">{{ item.city }}, <span>{{ item.state }}</span></h4>
                        <!-- <div class="card-title">City: {{ item.city }}</div> -->
                        <h6 class="card-title">Address: {{ item.address }}</h6>
                        <!-- <p class="card-text flex-grow-1">{{ item.excerpt }}</p> -->
                        <router-link :to="{ name: 'apartment', params: { slug: item.slug } }"
                            class="btn btn-danger">Details</router-link>
                    </div>
                </div>
            </div>

            <!-- <nav class="mt-3">
                <ul class="pagination">
                    <li
                        class="page-item"
                        :class="{disabled: results.current_page == 1}"
                        @click="changePage(results.current_page - 1)"
                    >
                        <span class="page-link">Previous</span>
                    </li>
                    <li
                        v-for="page in results.last_page"
                        :key="page"
                        class="page-item"
                        :class="{active: results.current_page == page}"
                        @click="changePage(page)"
                    >
                        <span class="page-link" href="">{{ page }}</span>
                    </li>
                    <li
                        class="page-item"
                        :class="{disabled: results.current_page == results.last_page}"
                        @click="changePage(results.current_page + 1)"
                    >
                        <span class="page-link">Next</span>
                    </li>
                </ul>
            </nav> -->
        </div>
        <div v-else>
            <img class="d-flex m-auto" src="https://media.tenor.com/OTzJy4d4xGMAAAAC/computer-stick-man.gif" alt="gif">
        </div>
    </section>
</template>

<script>

export default {
    data() {
        return {
            results: null,
            searchTerm: ""
        };
    },
    methods: {
        changePage(page) {
            axios.get('/api/apartments?page=' + page)
                .then(response => this.results = response.data.results);
        }
    },
    created() {
        this.changePage(1);
    },

    computed: {

        filteredItems() {
            return this.results.data.filter(apartment => {
                const address = apartment.address.toLowerCase();
                const city = apartment.city.toLowerCase();
                const searchTerm = this.searchTerm.toLowerCase();
                return address.includes(searchTerm) || city.includes(searchTerm);
            });
        },
    }
};
</script>

<style lang="scss" scoped>

@import url('https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap');

* {
    font-family: 'Bree Serif', serif;
}
.container {
    margin-top: 100px;
}
.pagination {
    cursor: pointer,
}

;

.apt-card {
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;

    &:hover {
        transform: scale(1.03);
        transition: 0.7s;
    }
}

.btn-danger {
    --bs-btn-bg: #bd1c1c;
    --bs-btn-hover-bg: rgb(245, 245, 245);
    --bs-btn-hover-color: #bd1c1c;
}
</style>
