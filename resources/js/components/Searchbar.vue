<template>
    <div class="container">
        <div class="input-group mb-3">
            <input v-model="query" type="text" class="form-control" placeholder="Order Number"
                   aria-label="Order Number"
                   aria-describedby="basic-addon2">
            <div class="input-group-append">
                <!-- <button class="btn btn-primary" @click="searchProducts" @keyup.enter="searchProducts" type="button">
                    Search
                </button> -->
                <button class="btn btn-warning" @click="store" type="button">
                    ADD
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Searchbar",
        data() {
            return {
                query: '',
                product: {},
            }
        },
        watch: {
            query: {
                handler: _.debounce(function () {
                    this.searchProducts()
                }, 100)
            }
        },
        methods: {
            searchProducts() {
                this.$store.dispatch('SEARCH_PRODUCTS', this.query)
            },
            store(id)
            {
            this.$swal.fire({
                title: 'Bestellung hinzufügen',
                html: `<input type="text" id="name" class="swal2-input" placeholder="name">
                       <input type="text" id="count" class="swal2-input" placeholder="count">
                       <input type="text" id="maxcount" class="swal2-input" placeholder="maxcount">`,
                confirmButtonText: 'Add',
                focusConfirm: false,
                preConfirm: () => {
                    const name = this.$swal.getPopup().querySelector('#name').value
                    const count = this.$swal.getPopup().querySelector('#count').value
                    const maxcount = this.$swal.getPopup().querySelector('#maxcount').value
                    if (!name || !count || !maxcount) {
                        this.$swal.showValidationMessage(`Bitte Daten vollständig angeben`)
                    }
                                        if(count > maxcount){
                        this.$swal.showValidationMessage(`Bitte Zählung überprüfen`)
                    }
                    return { name: name, count: count, maxcount: maxcount}
                }
                }).then((result) => {
                this.$swal.fire(`
                    name: ${result.value.name}
                    count: ${result.value.count}
                    maxcount: ${result.value.maxcount}
                `.trim())
                console.log(`${result.value.name}`, `${result.value.count}`, `${result.value.maxcount}`)
                    this.axios({
                        method: 'post',
                        url: '/api/store',
                        data: {
                            name: `${result.value.name}`,
                            count: `${result.value.count}`,
                            maxcount: `${result.value.maxcount}`
                        }
                    });
                    setTimeout(function(){ location.reload(); }, 2000);
                });
            }
            
        }
        }
</script>

<style scoped>

</style>