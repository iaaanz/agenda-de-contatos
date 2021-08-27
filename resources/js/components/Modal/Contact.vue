<template>
  <transition name="modal">
    <div class="modal-mask ">
      <div class="modal-wrapper">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="card primary">
              <div class="card-header p-3">
                <div class="row">
                  <h3 class="text-center text-white">Novo Contato</h3>
                </div>
              </div>
              <div class="card-body bg-white">
                <form>
                  <div class="row">
                    <div class="col">
                      <v-text-field
                        label="Nome"
                      ></v-text-field>
                    </div>
                    <div class="col">
                      <v-text-field
                        label="E-mail"
                      ></v-text-field>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-5">
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
                    <div class="col">
                      <v-text-field
                        v-model="lograd"
                        disabled
                        label="Logradouro"
                      ></v-text-field>
                    </div>
                  </div>
                  <!-- TODO: Finalizar com os campos faltantes -->
                </form>
              </div>
              <div class="card-footer text-center bg-white">
                <v-btn
                  color="green"
                  class="no-uppercase white--text"
                  elevation="2"
                >
                  Salvar
                </v-btn>
                <v-btn
                  color="red"
                  class="no-uppercase white--text"
                  elevation="2"
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
  </transition>
</template>

<script>
export default {
  name: 'ContactModal',
  data() {
    return {
      phone: '',
      cep: '',
      num: '',
      lograd: 'Rua Alberto Biavatti'
    }
  },
  methods: {
    close() {
      this.$emit('close');
    },
    maskTel(phone) {
      if (!phone) {
        return this.phone.length === 15 ? '(##) #####-####' : '(##) ####-#####'
      }
    },
    maskCep(cep) {
      if (!cep) {
        return this.cep.length === 5 ? '' : '#####-###'
      }
    }
  }
};
</script>
<style>

  .primary {
    border: none;
    border-radius: 1rem;
  }

  .modal-content {
    border: none;
    background-color: transparent;
  }

.modal-mask {
  position: fixed;
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
