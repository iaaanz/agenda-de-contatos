<template>
  <transition name="modal">
    <div class="modal-mask ">
      <div class="modal-wrapper">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="card card-border primary">
              <div class="card-header p-3">
                <div class="row">
                  <h3 class="text-white">{{ title }}</h3>
                </div>
              </div>
              <div class="card-body bg-white">
                <v-form
                  id="contact-registration-form"
                  ref="form"
                  v-model="valid"
                  lazy-validation
                  @submit.prevent="formSubmit"
                >
                  <div class="row">
                    <div class="col-5 my-auto">
                      <PictureInput
                        ref="pictureInput"
                        :key="reloadImg"
                        :removable="true"
                        :remove-button-class="`no-uppercase white--text
                        v-btn v-btn--is-elevated v-btn--has-bg
                        v-btn--rounded theme--light elevation-2 v-size--default primary`"
                        :hide-change-button="true"
                        :prefill="fields.image || defaultImgUrl"
                        width="120"
                        height="120"
                        accept="image/jpeg,image/png"
                        button-class="btn"
                        radius="50"
                        :custom-strings="{
                          remove: 'Remover'
                        }"
                        @remove="onRemove"
                        @change="onChange"
                      />
                    </div>
                    <div class="col-7">
                      <v-text-field
                        v-model="fields.name"
                        label="Nome"
                        :rules="[rules.required]"
                        maxlength="50"
                      ></v-text-field>
                      <v-text-field
                        v-model="fields.email"
                        label="E-mail"
                        maxlength="40"
                      ></v-text-field>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-5">
                      <v-text-field
                        v-model="fields.phone"
                        v-mask="'(##) #####-####'"
                        label="Telefone"
                        maxlength="15"
                      ></v-text-field>
                    </div>
                    <div class="col">
                      <v-text-field
                        v-model="fields.cep"
                        v-mask="'#####-###'"
                        label="Cep"
                        maxlength="9"
                        @keyup="fillAddress()"
                      ></v-text-field>
                    </div>
                    <div class="col-3">
                      <v-text-field
                        v-model="fields.num"
                        label="Número"
                        maxlength="10"
                      ></v-text-field>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <v-text-field
                        v-model="fields.address.logradouro"
                        disabled
                        label="Logradouro"
                        maxlength="100"
                      ></v-text-field>
                    </div>
                    <div class="col">
                      <v-text-field
                        v-model="fields.address.complemento"
                        label="Complemento"
                        maxlength="50"
                      ></v-text-field>
                    </div>
                    <div class="col-3 col-sm-2">
                      <v-text-field
                        v-model="fields.address.uf"
                        disabled
                        label="UF"
                        maxlength="2"
                      ></v-text-field>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <v-text-field
                        v-model="fields.address.bairro"
                        disabled
                        label="Bairro"
                        maxlength="50"
                      ></v-text-field>
                    </div>
                    <div class="col-12 col-sm-6">
                      <v-text-field
                        v-model="fields.address.localidade"
                        disabled
                        label="Cidade"
                        maxlength="50"
                      ></v-text-field>
                    </div>
                  </div>
                </v-form>
              </div>
              <div class="card-footer bg-white">
                <div class="row p-3">
                  <v-btn
                    rounded
                    type="submit"
                    form="contact-registration-form"
                    color="primary"
                    class="no-uppercase white--text"
                    elevation="2"
                    :disabled="!valid"
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

export default {
  name: 'Contact',
  components: { PictureInput },
  props: {
    contactId: {
      type: Number,
      default: null
    }
  },
  data() {
    return {
      valid: true,
      isEditing: false,
      reloadImg: 0,
      defaultImgUrl: 'img/default_user.png',
      title: 'Novo Contato',
      fields: {
        address: {},
        cep: '',
        phone: '',
      },
      rules: {
        required: value => !!value || 'Obrigatório',
      }
    }
  },
  async mounted() {
    if (this.contactId) {
      this.isEditing = true;
      this.title = 'Editar Contato';
      await this.axios.get(`/api/agenda/edit/${this.contactId}`)
        .then(res => {
          this.fields.image = res.data.img_path;
          this.fields.name = res.data.name;
          this.fields.phone = res.data.phone;
          this.fields.cep = res.data.zip_code;
          this.fields.email = res.data.email;
          this.fields.num = res.data.addr_number;
          this.fields.address.logradouro = res.data.address;
          this.fields.address.complemento = res.data.complement;
          this.fields.address.uf = res.data.uf;
          this.fields.address.bairro = res.data.district;
          this.fields.address.localidade = res.data.city;
        })
        .catch()
    }
  },
  methods: {
    onChange(img) {
      if (img) this.fields.image = this.$refs.pictureInput.file
    },
    onRemove() {
      this.reloadImg += 1;
      this.fields.image = '';
    },
    formSubmit() {
      if (!this.$refs.form.validate()) return

      const config = {
        header: {
          'content-type': 'multipart/form-data'
        }
      }

      const data = new FormData();
      data.append('name', this.fields.name || '')
      data.append('email', this.fields.email || '')
      data.append('phone', this.fields.phone || '')
      data.append('zip_code', this.fields.cep || '')
      data.append('addr_number', this.fields.num || '')
      data.append('address', this.fields.address.logradouro || '')
      data.append('complement', this.fields.address.complemento || '')
      data.append('uf', this.fields.address.uf || '')
      data.append('district', this.fields.address.bairro || '')
      data.append('city', this.fields.address.localidade || '')
      data.append('img_user', this.fields.image || '')

      this.valid = false;
      if (this.isEditing) {
        data.append('_method', 'PATCH');
        return this.axios.post(`/api/agenda/${this.contactId}`, data, config)
          .then(res => {
            if (res.status === 200) {
              this.$emit('fetchContacts')
              this.$notify({
                group: 'contact-notification',
                type: 'success',
                title: 'Sucesso',
                text: 'Contato salvo!',
              });
            } else {
              this.$notify({
                group: 'contact-notification',
                type: 'error',
                title: 'Erro',
                text: 'Ops! Não foi possível salvar, tente novamente.',
              });
            }
            this.close();
          })
          .catch(() => {
            this.$notify({
              group: 'contact-notification',
              type: 'error',
              title: 'Erro',
              text: 'Ops! Não foi possível salvar, tente novamente.',
            });
          })
      }
      return this.axios.post('/api/agenda/create', data, config)
        .then(res => {
          if (res.status === 200) {
            this.$emit('fetchContacts')
            this.$notify({
              group: 'contact-notification',
              type: 'success',
              title: 'Sucesso',
              text: 'Contato salvo!',
            });
          } else {
            this.$notify({
              group: 'contact-notification',
              type: 'error',
              title: 'Erro',
              text: 'Ops! Algo deu errado, tente novamente.',
            });
          }
          this.close();
        })
        .catch(() => {
          this.$notify({
            group: 'contact-notification',
            type: 'error',
            title: 'Erro',
            text: 'Ops! Algo deu errado, tente novamente.',
          });
          this.close();
        })
    },
    fillAddress() {
      // eslint-disable-next-line no-return-assign
      return this.fields.cep.length === 9 ? this.getAddress() : this.fields.address = {};
    },
    getAddress() {
      this.axios.get(`https://viacep.com.br/ws/${this.fields.cep}/json/`)
        .then(res => {
          this.fields.address = res.data;
        })
        .catch()
    },
    close() {
      this.$emit('close');
    },
  }
};
</script>
<style>
  .rmv-button {
    color: aqua;
  }

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
