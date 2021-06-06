<!-- Form de Adicionar quadros -->
<template>
  <form>
    <!-- Input do nome do quadro -->
    <ion-item>
      <ion-label position="stacked">Nome da Lista</ion-label>
      <ion-input
        v-model="list_name"
        maxlength="25"
        inputmode="text"
        placeholder="Insira o nome da lista"
        required="true"
      ></ion-input>
    </ion-item>
    <!-- Botão de enviar -->
    <ion-button expand="block" color="primary" @click="createList">
      Salvar
    </ion-button>
  </form>
</template>

<script>
import { IonButton, IonLabel, IonItem, IonInput } from "@ionic/vue";
import { axiosHttp } from "../tools/axios.js";
export default {
  components: {
    IonItem,
    IonButton,
    IonLabel,
    IonInput,
  },
  props: {
    board_id: Number,
  },
  data() {
    return {
      list_name: "",
    };
  },
  methods: {
    createList() {
      if (this.list_name != null) {
        //Função para salvar a lista dada
        let form = new FormData();
        form.append("list_name", this.list_name);
        form.append("board_id", this.board_id);
        axiosHttp
          .post("trosso.php", form, {
            params: { op: "createList" },
          })
          .then((resp) => {
            if (resp.data.sucesso) {
              this.$emit("close");
            }
          });
      }
    },
  },
};
</script>

<style scoped>
form {
  padding: 15%;
}
ion-item {
  margin: 30% auto 15% auto;
}

ion-content ion-button {
  margin: 0 auto;
}
</style>
