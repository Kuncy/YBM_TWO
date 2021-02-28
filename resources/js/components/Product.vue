<template>
    <div class="card">
        <div class="card-body" id="card-body" v-if="product.count == product.maxcount">
            <h5 class="card-title">Number: {{product.name}}</h5>
            <p class="card-text">Count: {{product.count}}/{{product.maxcount}}</p>
            <button class="btn btn-secondary" @click = "plus(product.id)">+</button>
            <button class="btn btn-secondary" @click= "minus(product.id)">-</button>
            <button class="btn btn-primary" @click = "deletePost(product.id)">Completed</button>
        </div>
          <div class="card-body" id="else" v-if="product.count != product.maxcount">
            <h5 class="card-title">Number: {{product.name}}</h5>
            <p class="card-text">Count: {{product.count}}/{{product.maxcount}}</p>
            <button class="btn btn-secondary" v-if="product.count < product.maxcount" @click = "plus(product.id)">+</button>
            <button class="btn btn-secondary" @click= "minus(product.id)">-</button>
        </div>
    </div>
</template>

<script>
export default {
  components: {},
        name: "Product",
        props: ['product'],
        methods: {
        plus(id)
        {
            let tmp = this.product.count;
            if(this.product.count < this.product.maxcount){
            tmp++
            this.product.count = tmp;
            this.axios({
                method: 'put',
                url: `/api/plus/${id}`,
                data: {
                    count: this.product.count
                }
            
            });
        }

        },
        minus(id)
        {
            let tmp = this.product.count;
            if(this.product.count > 0){
            tmp--
            this.product.count = tmp;
            this.axios({
                method: 'put',
                url: `/api/minus/${id}`,
                data: {
                    count: this.product.count
                }

            });
            }
        },
        deletePost(id)
        {
            this.$swal.fire({
                title: 'Bestellelung wirklich abschließen',
                text: "Die Daten werden unwiederruflich aus der Ansicht entfernt",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel'
                }).then((result) => {
                if (result.value) {
                    this.$swal.fire({
                        title: 'Erfolgreich!',
                        text: 'Bestellung erfolgreich abgeschlossen',
                        icon: 'success',
                        timer: 1000
                    });
                    let uri = `api/delete/${id}`;
                    this.axios.delete(uri).then(response => {
                        setTimeout(function(){ location.reload(); }, 2000);
                    });
                    console.log("Deleted article with id ..." +id);
                }
            })
        }
    }
}
</script>

<style>
    .card-body
    {
        height: 17vh;
    }
    #card-body
    {
        background-color: lightgreen;
    }
</style>

<style scoped>
    .card {
        cursor: default;
        margin-bottom: 8px;
    }
</style>