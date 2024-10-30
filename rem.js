let voices = [];

function loadVoices() {
    voices = speechSynthesis.getVoices();
}

function startReminders() {
    const tabletTime = document.getElementById('reminderTime').value;
    const checkupDate = new Date(document.getElementById('checkupDate').value);
    const selectedLanguage = document.getElementById('languageSelect').value;

    function checkReminders() {
        const now = new Date();
        const currentTime = now.toTimeString().split(' ')[0].slice(0, 5); 

        if (currentTime === tabletTime) {
            speak("It's time to take your tablet.", selectedLanguage);
        }

        if (now.toDateString() === checkupDate.toDateString()) {
            speak("It's time for your monthly check-up.", selectedLanguage);
        }
    }

    setInterval(checkReminders, 60000); 
}

function speak(text, language) {
    const utterance = new SpeechSynthesisUtterance(text);
    const selectedVoice = voices.find(voice => voice.lang === language);

    
    if (selectedVoice) {
        utterance.voice = selectedVoice;
    } else {
        console.warn("Selected language voice not found, using default.");
    }

    speechSynthesis.speak(utterance);
}


window.speechSynthesis.onvoiceschanged = loadVoices;
