<template>
<div class="my_apt_sponsor">
    <div class="my_form_">
        <tomtomsearch :is-in-edit-mode='true' @coordinates="saveCoordinates" @edit="setEdit"></tomtomsearch>
        <p>Distanza max dall'indirizzo indicato:</p>
        <input class="km" type="text" v-model="radius">
        <label class="km" for="distance">Km </label><br><br>

        <span>Seleziona gli ospiti : {{ guests }}</span>
        <select v-model="guests" @change="onChange">
            <option disabled value="0">Seleziona gli ospiti</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
        </select><br><br>

        <span>Seleziona le stanze : {{ rooms }}</span>
        <select v-model="rooms" @change="onChange">
            <option disabled value="0">Seleziona le stanze</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
        </select><br><br>

        <span class="my_select">Servizi inclusi:</span><br>
        <div id='check'>
            <fieldset :disabled="setCheckboxes">
                <label class='check-item'>
                    <input type="checkbox" value="1" v-model="checkedServices" @change="onChange">
                    <span>Wifi</span>
                    <i class="fas fa-wifi"></i>
                </label>
                <label class='check-item'>
                    <input type="checkbox" value="2" v-model="checkedServices" @change="onChange">
                    <span>Piscina</span>
                    <i class="fas fa-swimmer"></i>
                </label>
                <label class='check-item'>
                    <input type="checkbox" value="3" v-model="checkedServices" @change="onChange">
                    <span>Vista mare</span>
                    <i class="fas fa-umbrella-beach"></i>
                </label>
                <label class='check-item'>
                    <input type="checkbox" value="4" v-model="checkedServices" @change="onChange">
                    <span>Posto auto</span>
                    <i class="fas fa-parking"></i>
                </label>
                <label class='check-item'>
                    <input type="checkbox" value="5" v-model="checkedServices" @change="onChange">
                    <span>Portineria</span>
                    <i class="fas fa-concierge-bell"></i>
                </label>
                <label class='check-item'>
                    <input type="checkbox" value="6" v-model="checkedServices" @change="onChange">
                    <span>Sauna</span>
                    <i class="fas fa-hot-tub"></i>
                </label>
            </fieldset>
        </div>
        <div id="my_btn">
            <button @click="onClick" :disabled="setCheckboxes"> Cerca </button>
        </div>

    </div>

    <div class="sponsorship-apt-list">
        <div v-if="resultsSponsored.length">
            <div class="my_box-apt sponsored">
                <div v-for="apartment in resultsSponsored" class="apartment sponsored">
                    <h2>{{ apartment.title }}</h2>
                    <p><span><i class="fas fa-map-marked-alt"></i></span> {{ apartment.address }}</p>
                    <p><span><i class="fas fa-coins"></i></span>{{ apartment.price}}</p>
                    <div class="image">
                        <img :src="'/storage/' + apartment.image" alt="">
                        <i class="fab fa-gratipay"></i>
                        <div class="my_btn">
                            <a class="m-button" :href="'apartment/' + apartment.id">Visualizza</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="resultsNoSponsored.length">
            <div class="my_box-apt">
                <div v-for="apartment in resultsNoSponsored" class="apartment">
                    <h2>{{ apartment.title }}</h2>
                    <p><span><i class="fas fa-map-marked-alt"></i></span> {{ apartment.address }}</p>
                    <p><span><i class="fas fa-coins"></i></span>{{ apartment.price}}</p>
                    <div class="image">
                        <img :src="'/storage/' + apartment.image" alt="">
                        <i class="fab fa-gratipay"></i>
                        <div class="my_btn">
                            <a class="m-button" :href="'apartment/' + apartment.id">Visualizza</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <h1>{{ noApartments }}</h1>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data: function() {
        return {
            guests: 0,
            rooms: 0,
            radius: 20,
            address_lat: 0,
            address_lon: 0,
            checkedServices: [],
            resultsSponsored: [],
            resultsNoSponsored: [],
            noApartments: "",
            search: false,
            checkboxes: false
        }
    },
    props: {},
    computed: {
        setCheckboxes() {
            return !this.checkboxes;
        }
    },
    methods: {
        getData() {
            var _this = this;
            axios.get('/api/filter', {
                    params: {
                        address_lat: this.address_lat,
                        address_lon: this.address_lon,
                        radius: this.radius,
                        rooms_number: this.rooms,
                        guests_number: this.guests,
                        services: this.checkedServices
                    }
                })
                .then(function(response) {
                    console.log(response);
                    if (response.data.apartments.length) {
                        for (let item of response.data.apartments) {
                            if (item.sponsorships.length) {
                                item.sponsorships.forEach(function(sponsorship) {
                                    if (sponsorship.pivot.expired == 0) {
                                        _this.resultsSponsored.push(item);
                                    } else {
                                        _this.resultsNoSponsored.push(item);
                                    }
                                });
                            } else {
                                _this.resultsNoSponsored.push(item);
                            }
                        }

                    } else {
                        _this.noApartments = 'Nessun risultato trovato, modifica i criteri di ricerca!';
                    }
                })
                .catch(function(error) {
                    console.log(error);
                })
        },
        saveCoordinates(lat, lon) {
            this.address_lat = lat;
            this.address_lon = lon;
            this.checkboxes = true;
        },
        onClick() {
            this.getData();
            this.resultsSponsored = [];
            this.resultsNoSponsored = [];
            this.noApartments = "";
            this.search = true;
        },
        onChange() {
            if (this.search) {
                this.resultsSponsored = [];
                this.resultsNoSponsored = [];
                this.noApartments = "";
                this.search = true;
                this.getData();
            }
        },
        setEdit() {
            this.checkboxes = false;
            this.search = false;
            this.checkedServices = [];
            this.guests = 0;
            this.rooms = 0;
        }
    }
}
</script>
<style lang="scss" scoped>
.box-form {
    //alternative form maybe debug
    padding: 40px;
}
</style>
