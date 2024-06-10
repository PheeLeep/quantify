$("#dateRangePicker").daterangepicker({
  opens: "left",
  autoUpdateInput: false,
  locale: {
    format: "MMMM D, YYYY",
  },
});

$("#dateRangePicker").on("apply.daterangepicker", function (ev, picker) {
  $(this).val(
    picker.startDate.format("MMMM D, YYYY") +
      " - " +
      picker.endDate.format("MMMM D, YYYY")
  );
});

// Clear the date range picker when the cancel button is clicked
$("#dateRangePicker").on("cancel.daterangepicker", function (ev, picker) {
  $(this).val("");
});
