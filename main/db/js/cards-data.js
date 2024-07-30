class Card
{
    constructor(buffer)
    {
        this.element;
        this.id = buffer.id;
        this.image = buffer.image;
        this.name = buffer.name;
        this.type = buffer.type;
        this.date = buffer.date;
        this.time = buffer.time;
        this.sound = buffer.sound;
        this.createCard(buffer);
    }
    createCard(buffer)
    {
        let soundsContainer = document.getElementById('sounds-container');

        this.element = document.createElement('div');
        this.element.className = 'sound-container';

        let soundPlayButton = document.createElement('button');
        soundPlayButton.className = 'sound-container__play';

        let soundContainerPlayIcon = document.createElement('img');
        soundContainerPlayIcon.loading = 'lazy';
        soundContainerPlayIcon.src = 'main/img/svg/play.svg';
        soundPlayButton.appendChild(soundContainerPlayIcon);

        let soundInfo = document.createElement('div');
        soundInfo.className = 'sound-info';
        let soundName = document.createElement('span');
        let soundType = document.createElement('span');
        soundName.textContent = this.name;
        soundType.textContent = this.type;
        soundInfo.appendChild(soundName);
        soundInfo.appendChild(soundType);

        let soundInfoAdvanced = document.createElement('div');
        soundInfoAdvanced.className = 'sound-info-advanced';

        let soundOptions = document.createElement('div');
        soundOptions.className = 'sound-options';
        
        let soundLike = document.createElement('button');
        let soundBookmark = document.createElement('button');
        soundLike.className = 'sound-like';
        soundBookmark.className = 'sound-bookmark';
        let soundLikeImage = document.createElement('img');
        let soundBookmarkImage = document.createElement('img');
        soundLikeImage.loading = 'lazy';
        soundLikeImage.src = 'main/img/svg/likes.svg';
        soundLikeImage.alt = 'like';
        soundBookmarkImage.loading = 'lazy';
        soundBookmarkImage.src = 'main/img/svg/bookmarks.svg';
        soundBookmarkImage.alt = 'bookmark';

        soundLike.appendChild(soundLikeImage);
        soundBookmark.appendChild(soundBookmarkImage);

        soundOptions.appendChild(soundLike);
        soundOptions.appendChild(soundBookmark);

        let soundDate = document.createElement('span');
        soundDate.className = 'sound-date';
        soundDate.textContent = `${this.date} ${this.time}`;

        soundInfoAdvanced.appendChild(soundOptions);
        soundInfoAdvanced.appendChild(soundDate);

        this.element.appendChild(soundPlayButton);
        this.element.appendChild(soundInfo);
        this.element.appendChild(soundInfoAdvanced);

        soundsContainer.appendChild(this.element);
    }
}

/*Отслеживание изменений в глобальной переменной globalSheets*/
function watchGlobalSheets(sheetName, callback)
{
    let value;
    Object.defineProperty(window, sheetName,
        {
        get()
        {
            return value;
        },
        set(newValue) {
            if (value === undefined && newValue !== null)
            {
                callback(newValue);
            }
            value = newValue;
        },
        configurable: true,
        enumerable: true
    });
}

function onGlobalSheetsChanged(value)
{
    const buffer = extractDataForLastSoundsData(value);
    console.log(buffer[0]);
    
    const card1 = new Card(buffer[0]);
    const card2 = new Card(buffer[1]);
    const card3 = new Card(buffer[2]);
    const card4 = new Card(buffer[3]);
}

watchGlobalSheets('globalSheets', onGlobalSheetsChanged);


/*Основные функции и классы для работы с карточками*/
function extractDataForLastSoundsData(globalSheets)
{
    let extractedDataArray = [];
    for(let i = globalSheets[0].rows.length - 4, j = 0; i < globalSheets[0].rows.length; i++, j++)
    {
        extractedDataArray[j] = 
        {
            id: parseInt(globalSheets[0].rows[i][0]),
            image: globalSheets[0].rows[i][1],
            name: globalSheets[0].rows[i][2],
            type: globalSheets[0].rows[i][3],
            date: globalSheets[0].rows[i][4],
            time: globalSheets[0].rows[i][5],
            sound: globalSheets[0].rows[i][6]
        }
    }
    return extractedDataArray;
}
