<template>
  <transition name="modal">
    <div class="modal-mask ">
      <div class="modal-wrapper">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="card card-border primary">
              <div class="card-header p-3">
                <div class="row">
                  <h3 class="text-white">Novo Contato</h3>
                </div>
              </div>
              <div class="card-body bg-white">
                <v-form
                  ref="form"
                  v-model="valid"
                  lazy-validation
                >
                  <div class="row">
                    <div class="col-5 my-auto">
                      <PictureInput
                        :hide-change-button="true"
                        :prefill="defaultImgUrl"
                        width="120"
                        height="120"
                        accept="image/jpeg,image/png"
                        button-class="btn"
                        radius="50"
                      />
                    </div>
                    <div class="col-7">
                      <v-text-field
                        label="Nome"
                        :rules="nameRule"
                      ></v-text-field>
                      <v-text-field
                        label="E-mail"
                      ></v-text-field>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-5">
                      <v-text-field
                        v-model="phone"
                        v-mask="maskTel()"
                        label="Telefone"
                      ></v-text-field>
                    </div>
                    <div class="col">
                      <v-text-field
                        v-model="cep"
                        v-mask="maskCep()"
                        label="Cep"
                        @keyup="fillAddress()"
                      ></v-text-field>
                    </div>
                    <div class="col-3">
                      <v-text-field
                        v-model="num"
                        label="Número"
                      ></v-text-field>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <v-text-field
                        v-model="address.logradouro"
                        disabled
                        label="Logradouro"
                      ></v-text-field>
                    </div>
                    <div class="col">
                      <v-text-field
                        v-model="address.complemento"
                        label="Complemento"
                      ></v-text-field>
                    </div>
                    <div class="col-3 col-sm-2">
                      <v-text-field
                        v-model="address.uf"
                        disabled
                        label="UF"
                      ></v-text-field>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <v-text-field
                        v-model="address.bairro"
                        disabled
                        label="Bairro"
                      ></v-text-field>
                    </div>
                    <div class="col-12 col-sm-6">
                      <v-text-field
                        v-model="address.localidade"
                        disabled
                        label="Cidade"
                      ></v-text-field>
                    </div>
                  </div>
                </v-form>
              </div>
              <div class="card-footer bg-white">
                <div class="row p-3">
                  <v-btn
                    rounded
                    color="primary"
                    class="no-uppercase white--text"
                    elevation="2"
                    :disabled="!valid"
                    @click="validate"
                  >
                    Salvar
                  </v-btn>
                  <v-btn
                    text
                    rounded
                    class="mt-2 no-uppercase primary--text"
                    @click="close"
                  >
                    Cancelar
                  </v-btn>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import PictureInput from 'vue-picture-input'
import axios from 'axios'

export default {
  name: 'ContactModal',
  components: { PictureInput },
  data() {
    return {
      valid: true,
      defaultImgUrl: 'img/default_user.png',
      cep: '',
      address: '',
      phone: '',
      num: '',
      img: '',
      nameRule: [
        value => !!value || 'Obrigatório',
      ],
    }
  },
  methods: {
    validate () {
      this.$refs.form.validate()
    },
    fillAddress() {
      // eslint-disable-next-line no-return-assign
      return this.cep.length !== 9 ? this.address = '' : this.getAddress();
    },
    getAddress() {
      axios.get(`https://viacep.com.br/ws/${this.cep}/json/`)
        .then(res => {
          this.address = res.data;
        })
        .catch(err => console.log(err))
    },
    maskTel() {
      if (this.phone) {
        return this.phone.length === 15 ? '(##) #####-####' : '(##) ####-#####'
      }
    },
    maskCep() {
      if (this.cep) {
        return this.cep.length === 5 ? '' : '#####-###'
      }
    },
    close() {
      this.$emit('close');
    },
  }
};
</script>
<style>
  .card-border {
    border: none;
    border-radius: 1rem;
  }

  .card-footer {
    border-radius: 0 0 1rem 1rem !important;
  }

  .modal-content {
    border: none;
    background-color: transparent;
  }

  .modal-mask {
    position: absolute;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
  }

  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
  }

  .modal-body {
    margin: 20px 0;
  }

  .modal-default-button {
    float: right;
  }

  .modal-enter {
    opacity: 0;
  }

  .modal-leave-active {
    opacity: 0;
  }

  .modal-enter .modal-container,
  .modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }

</style>
