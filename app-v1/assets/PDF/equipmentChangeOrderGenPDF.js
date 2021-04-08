// equipment change order form PDF download
window.onload = function () {
    document.getElementById("downloadEquipmentChangeOrderFormPDF")
        .addEventListener("click", () => {
            const equipmentChangeOrderForm = this.document.getElementById("equipmentChangeOrderForm");
            console.log(equipmentChangeOrderForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'equipmentChangeOrderForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(equipmentChangeOrderForm).set(opt).save();
        })
}
