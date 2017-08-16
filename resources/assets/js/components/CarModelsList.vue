<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <transition name="fade">
                    <div class="alert alert-success" v-if="message">
                        {{message}}
                    </div>
                </transition>

                <div class="alert alert-danger" v-if="isError">
                    {{errorMessage}}
                </div>

                <transition-group name="bounce" tag="div">                
                    <div class="panel panel-primary" v-for="model in carModelsData" :key="model.modelId">
                        <div class="panel-heading">
                            <h1 class="panel-title">Model Id: {{model.modelId}}</h1>
                        </div>
                        <div class="panel-body">    
                            <ul>
                                <li>Co2 Emissions: {{model.co2Emmissions}}</li>
                                <li>Engine Power: {{model.enginePower}}</li>
                                <li>Engine Size: {{model.engineSize}}</li>
                                <li>Fuel Type: {{model.fuelType}}</li>
                            </ul>
                            <table class="table">
                                <tr>
                                    <th>Car Id</th>
                                    <th>Mileage</th>
                                    <th>Registration</th>
                                    <th>Owners</th>
                                    <th>Transmission</th>
                                    <th>Price</th>
                                </tr>

                                <tr v-for="car in model.cars">
                                    <td>{{car.id}}</td>
                                    <td>{{car.mileage}}</td>
                                    <td>{{car.registration}}</td>
                                    <td>{{car.owners}}</td>
                                    <td>{{car.transmission}}</td>
                                    <td>{{car.price}}</td>
                                </tr>                        
                            </table>
                        </div>                          
                    </div>
                </transition-group>

            </div>
            <div class="col-md-4 well">
                <h3>Apply Filters</h3>
                <form>
                    <div class="form-group">
                        <label>Fuel Type:</label>
                        <select id="txtFuelType" v-model="fuelType" class="form-control">    
                            <option value="">Any</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label>Transmission:</label>
                        <select id="txtTransmission" v-model="transmission" class="form-control"> 
                            <option value="">Any</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>                        
                    </div>

                    <button id="btnApplyFilters" class="btn btn-primary btn-block" @click.prevent="applyFilters">Apply Filters</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                carModelsData: [],
                fuelType: '',
                transmission: '',
                isError: false,
                errorMessage: '',
                message: ''
            }
        },

        methods: {
            applyFilters: function () {
                let url = '/api/carmodels?fueltype=' + this.fuelType +
                         '&transmission=' + this.transmission;

                axios.get(url)
                    .then( response => {
                        this.carModelsData = response.data;  
                        this.isError = false;
                        this.errorMessage = '';         
                        this.message = 'Filters Applied!';
                        setTimeout(() => this.message = '', 3000);

                    }).catch( error => {
                        this.carModelsData = '';
                        this.isError = true;
                        this.errorMessage = "No Records Found";
                        this.message = '';
                    });
            }
        },

        mounted: function () {
            axios.get('/api/carmodels')
                .then( response => {
                    this.carModelsData = response.data;
                });

        }
    }
</script>
<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity 1s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
      opacity: 0;
    }

    .bounce-enter-active {
      animation: bounce-in .5s;
    }
    .bounce-leave-active {
      animation: bounce-in .5s reverse;
    }

    @keyframes bounce-in {
      0% {
        transform: scale(0);
      }
      50% {
        transform: scale(1.5);
      }
      100% {
        transform: scale(1);
      }
    }    

    .bounce-move {
        transition: transform 1s;
    }
</style>