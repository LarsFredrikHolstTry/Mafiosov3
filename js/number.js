function number_space(id) {
  $(id).on("keyup", function () {
    this.value = this.value.replace(/ /g, "");
    var number = this.value;
    this.value = number.replace(
      /\B(?=(\d{3})+(?!\d))/g,
      " "
    );
  });
}
