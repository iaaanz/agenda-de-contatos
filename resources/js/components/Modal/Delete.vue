<template>
  <v-row justify="center">
    <v-dialog
      v-model="show"
      max-width="440"
      content-class="v-dialog--custom"
    >
      <v-card>
        <v-card-title class="text-h5">
          Tem certeza que deseja excluir?
        </v-card-title>
        <v-card-text>Essa operação não pode ser desfeita.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="red darken-1"
            text
            @click="close()"
          >
            Cancelar
          </v-btn>
          <v-btn
            color="primary darken-1"
            text
            @click="confirmDelete()"
          >
            Sim
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  name: 'DeleteModal',
  props: {
    value: Boolean,
    contact: {
      type: Number,
      default: null
    },
  },
  computed: {
    show: {
      get () {
        return this.value
      },
      set (value) {
        this.$emit('input', value)
      }
    }
  },
  methods: {
    toastSuccessDelete() {
      this.$notify({
        group: 'contact-notification',
        type: 'success',
        title: 'Sucesso',
        text: 'Contato excluído!',
      });
    },
    toastErrorDelete() {
      this.$notify({
        group: 'contact-notification',
        type: 'error',
        title: 'Erro',
        text: 'Ops! Não foi possível excluir, tente novamente',
      });
    },
    confirmDelete() {
      this.axios.delete(`/api/agenda/${this.contact}`)
        .then(res => {
          if (res.status === 200) {
            this.$emit('contactDeleted')
            this.toastSuccessDelete();
          } else {
            this.toastErrorDelete();
          }
        })
        .catch(() => {
          this.toastErrorDelete()
        });
      this.close();
    },
    close() {
      this.$emit('close');
    }
  }
}
</script>

<style>
.v-dialog--custom {
  width: 100%;
}

@media only screen and (max-width: 375px) {
  .v-dialog--custom {
    width: 200px;
  }
}

@media only screen and (min-width: 400px) {
    .v-dialog--custom {
    width: 350px;
  }
}

@media only screen and (min-width: 600px) {
    .v-dialog--custom {
    width: 100%;
  }
}

</style>
