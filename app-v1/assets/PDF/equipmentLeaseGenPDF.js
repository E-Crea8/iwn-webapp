// Equipment lease form PDF download
window.onload = function () {
    document.getElementById("downloadEquipmentLeaseFormPDF")
        .addEventListener("click", () => {
            const equipmentLeaseForm = this.document.getElementById("equipmentLeaseForm");
            console.log(equipmentLeaseForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'equipmentLeaseForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(equipmentLeaseForm).set(opt).save();
        })
}






