<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-danger" v-if="isError">
                    {{errorMessage}}
                </div>
                <div class="panel panel-primary" v-for="model in carModelsData">
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
                errorMessage: ''
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
                    }).catch( error => {
                        this.carModelsData = '';
                        this.isError = true;
                        this.errorMessage = "No Records Found";
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
