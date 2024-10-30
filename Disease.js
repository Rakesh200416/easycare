const diseaseSeverityDetection = {
    "Common": {
        "Cold": ["sneezing", "runny nose", "sore throat", "cough", "congestion", "headache"],
        "Allergy": ["sneezing", "runny nose", "itchy eyes", "rash", "congestion", "itchy throat"],
        "Strep Throat": ["swollen tonsils", "sore throat", "fever", "red throat"],
        "Bronchitis": ["cough", "mucus", "fatigue", "shortness of breath", "chest discomfort"],
        "Sinusitis": ["facial pain", "nasal congestion", "runny nose", "headache", "sore throat", "cough"]
    },
    "Moderate": {
        "Flu": ["fever", "cough", "body ache", "sore throat", "headache", "fatigue", "chills"],
        "Food Poisoning": ["nausea", "vomiting", "diarrhea", "stomach cramps", "fever"],
        "Asthma": ["shortness of breath", "chest tightness", "cough", "wheezing"],
        "Diabetes": ["increased thirst", "frequent urination", "fatigue", "blurred vision", "weight loss"],
        "Hypertension": ["headache", "dizziness", "shortness of breath", "nosebleeds", "chest pain"],
        "Migraine": ["headache", "nausea", "sensitivity to light", "sensitivity to sound", "vision changes"],
        "Anemia": ["fatigue", "weakness", "pale skin", "shortness of breath", "dizziness", "cold hands and feet"]
    },
    "Serious": {
        "COVID-19": ["fever", "cough", "loss of taste", "loss of smell", "shortness of breath", "fatigue", "body ache"],
        "Pneumonia": ["fever", "cough", "chest pain", "shortness of breath", "fatigue", "sweating", "chills"],
        "Tuberculosis": ["persistent cough", "fever", "night sweats", "weight loss", "fatigue", "chest pain"],
        "Hepatitis": ["fatigue", "jaundice", "nausea", "abdominal pain", "loss of appetite", "dark urine"],
        "Typhoid": ["fever", "abdominal pain", "headache", "weakness", "loss of appetite", "rash"],
        "Chickenpox": ["fever", "rash", "itchiness", "fatigue", "headache"],
        "Dengue": ["fever", "severe headache", "muscle pain", "joint pain", "rash", "nausea"],
        "Chikungunya": ["fever", "joint pain", "muscle pain", "rash", "headache"]
    },
    "Deadly": {
        "Malaria": ["fever", "chills", "headache", "sweating", "nausea", "vomiting", "muscle pain"],
        "Meningitis": ["severe headache", "stiff neck", "fever", "sensitivity to light", "nausea", "vomiting"],
        "Cancer": ["unexplained weight loss", "fatigue", "pain", "skin changes", "persistent cough", "blood in urine"],
        "Ebola": ["fever", "severe headache", "muscle pain", "fatigue", "vomiting", "diarrhea", "bleeding"],
        "AIDS": ["persistent fever", "night sweats", "unexplained weight loss", "swollen lymph nodes", "weak immune system"]
    }
};

function detectDisease() {
    const symptomInput = document.getElementById("symptomInput").value.trim();
    const symptoms = symptomInput.split(',').map(symptom => symptom.trim());
    const resultDiv = document.getElementById("result");
    resultDiv.innerHTML = ''; // Clear previous results

    let foundDiseases = [];

    for (let severity in diseaseSeverityDetection) {
        for (let disease in diseaseSeverityDetection[severity]) {
            const diseaseSymptoms = diseaseSeverityDetection[severity][disease];
            if (symptoms.every(symptom => diseaseSymptoms.includes(symptom))) {
                foundDiseases.push(`${disease}: This is a ${severity.toLowerCase()} illness.`);
            }
        }
    }

    if (foundDiseases.length > 0) {
        resultDiv.innerHTML = foundDiseases.join('<br>');
    } else {
        resultDiv.innerHTML = "No diseases found matching the provided symptoms.";
    }
}