<template>
  <transition name="modal">
    <div class="modal-mask ">
      <div class="modal-wrapper">
        <div class="modal-container">
          <!-- <div class="modal-dialog"> -->
          <!-- <div class="modal-content"> -->
          <div class="modal-header">
            <h5 class="modal-title">Novo Contato</h5>
            <button
              type="button"
              class="btn-close"
              @click="close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="">
                <v-text-field
                  label="Nome"
                ></v-text-field>
              </div>
            </form>
          </div>
          <div class="modal-footer">
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
          <!-- </div> -->
          <!-- </div> -->
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: 'ContactModal',
  methods: {
    close() {
      this.$emit('close');
    },
  },
};
</script>
<style>

.no-uppercase {
  text-transform: none;
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

.modal-container {
  width: 600px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-footer {
  padding-bottom: 0;
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
