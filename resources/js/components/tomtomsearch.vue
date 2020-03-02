<template>
<div id="tomtomsearch">
    <div class="form_row_vue">
        <input class='input-text-vue' v-show="editMode" v-model="address" type="text" autocomplete="off" :required="editMode">
        <label for="address" class="label-input-vue">
            <span class="content-label-vue">Indirizzo</span>
        </label>
        <input class='input-text-vue-bis' v-show="!editMode" v-model="finaladdress" type="text" name="address" readonly>
        <span id="close" v-show="!editMode" @click="enterEditMode">X</span>
    </div>

    <ul>
        <address-tag :lon="result.position.lon" :lat="result.position.lat" :address="result.address.freeformAddress" v-for="(result, index) in results" :key="index" @click-address="setCoordinates">{{ result.address.freeformAddress }}
        </address-tag>
    </ul>
    <input type="text" id="lon" v-model="lon" name="address_lon">
    <input type="text" id="lat" v-model="lat" name="address_lat">
</div>
</template>

<script>
export default {

  props: ['savedAddress', 'isInEditMode', 'savedLat', 'savedLon'],

    data() {
        return {
            address: "",
            finaladdress: '',
            results: [],
            lon: 0,
            lat: 0,
            editMode: this.isInEditMode
        }
    },
    // computed:{
    //   editMode(){
    //
    //   }
    // },
    watch: {
        // quando address cambia, viene eseguita la funzione
        address: function(newAddress, oldAddress) {
            this.debounced()

        }
    },
    created: function() {
        //si usa la funzione _.debounce della libreria lodash per ritardare l'esecuzione della funzione e non generare
        //troppe ajax calls
        this.debounced = _.debounce(this.getAnswer, 1000);
        if(!this.editMode){
          this.finaladdress = this.savedAddress;
          this.lon = this.savedLon;
          this.lat = this.savedLat;
        }
    },

    methods: {
        getAnswer: function() {
            // if (this.address.length <= 3) {
            //   return
            // }
            var vm = this
            fetch(`https://api.tomtom.com/search/2/geocode/${this.address}.json?key=4plL73VgGOGRuTO2bSvJ1YZFmyuDVVaD&typeahead=true`)
                .then(function(res) {
                    return res.json();
                })
                .then(function(json) {
                    // handle success
                    console.log(json);
                    vm.results = json.results;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
        },
        setCoordinates(obj) {
            console.log(obj.long, obj.lati);
            this.lon = obj.long;
            this.lat = obj.lati;
            this.$emit('coordinates', this.lat, this.lon);
            this.address = "";
            this.finaladdress = obj.addr;
            this.results = [];
            this.editMode = false;
        },
        enterEditMode() {
            this.editMode = true;
            this.$emit('edit');
            this.lon = 0;
            this.lat = 0;
        }
    }
}
</script>
