<template>
  <div>
    <textarea
      placeholder="Adicione um texto para este card"
      v-model="description"
      ref="card"
    ></textarea>
    <div class="">
      <ion-button @click="createCard" class="">
        Adicionar cartão
      </ion-button>
      <ion-button @click="closed" class="">
        Cancelar
      </ion-button>
    </div>
  </div>
</template>

<script>
import { IonButton } from "@ionic/vue";
import { axiosHttp } from "../tools/axios.js";
export default {
  components: {
    IonButton,
  },
  props: {
    list: Object,
  },
  data() {
    return {
      description: null,
    };
  },
  mounted() {
    this.$refs.card.focus();
  },
  methods: {
    //createCard é uma função para salvar um card criado
    createCard() {
      let form = new FormData();
      form.append("card_description", this.description);
      form.append("list_id", this.list.id);
      axiosHttp
        .post("trosso.php", form, {
          params: { op: "createCard" },
        })
        .then((resp) => {
          if (resp.data.sucesso) {
            this.closed();
            this.$emit("card-added");
          }
        });
    },
    closed() {
      this.$emit("closed");
    },
  },
};
</script>
<style scoped></style>
