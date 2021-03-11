
// change order form PDF download
window.onload = function () {
    document.getElementById("downloadChangeOrderFormPDF")
        .addEventListener("click", () => {
            const changeOrderForm = this.document.getElementById("changeOrderForm");
            console.log(changeOrderForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'changeOrderForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(changeOrderForm).set(opt).save();
        })
}

// IP order form PDF download
window.onload = function () {
    document.getElementById("downloadIPOrderFormPDF")
        .addEventListener("click", () => {
            const ipOrderForm = this.document.getElementById("ipOrderForm");
            console.log(ipOrderForm);
            console.log(window);
            var opt = {
                margin: 0.5,
                filename: 'ipOrderForm.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().from(ipOrderForm).set(opt).save();
        })
}


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