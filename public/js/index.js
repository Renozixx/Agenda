class Redirect {
    sendGET (url = "/")
    {
        window.location.href = url
    }

    getURL ()
    {
        return window.location.href
    }
}

class TaskAside {
    closeAside ()
    {
        let content = document.getElementsByClassName("content")[0]
        let aside = content.querySelector(".aside")
        aside.classList.add("hidden")
    }
    
    openAside (year, month)
    {
        let content = document.getElementsByClassName("content")[0]
        let aside = content.querySelector(".aside")
        aside.classList.remove("hidden")
    }

    addEvent ()
    {
        let content = document.getElementsByClassName("content")[0]
        let aside = content.querySelector(".aside")
        let xaside = aside.querySelector(".x-aside")
        let month = content.querySelector(".month")
        let day = month.querySelectorAll(".day")
        xaside.addEventListener("click", () => {
            this.closeAside()
        })
    }
}