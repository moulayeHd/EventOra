const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {

        let target = +counter.getAttribute('data-target');

        let count = 0;

        let duration = 4;

        let incrementTime = 20;

        let totalSteps = (duration * 1000) / incrementTime;

        let increment = target / totalSteps;

        let timer = setInterval(() => {

            count += increment;

            if(count >= target){
                count = target;
                clearInterval(timer);
            }

            if(target >= 1000){
                counter.innerText = (count / 1000).toFixed(1) + "K";
            }else{
                counter.innerText = Math.floor(count);
            }

        }, incrementTime);

    });

