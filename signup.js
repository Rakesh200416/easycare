document.getElementById('userType').addEventListener('change', function() {
    const doctorFields = document.getElementById('doctorFields');
    const patientFields = document.getElementById('patientFields');

    if (this.value === 'doctor') {
        doctorFields.classList.remove('hidden');
        patientFields.classList.add('hidden');
    } else if (this.value === 'patient') {
        patientFields.classList.remove('hidden');
        doctorFields.classList.add('hidden');
    } else {
        doctorFields.classList.add('hidden');
        patientFields.classList.add('hidden');
    }
});
