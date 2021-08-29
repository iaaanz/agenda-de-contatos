<template>
  <v-row justify="center">
    <v-dialog
      v-model="show"
      max-width="320"
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
    confirmDelete() {
      this.axios.delete(`/api/agenda/${this.contact}`)
        .then(res => {
          console.log(res.data);
          this.$emit('contactDeleted')
          this.close();
        })
        .catch(err => {
          this.close();
        });
    },
    close() {
      this.$emit('close');
    }
  }
}
</script>

<style>

</style>
