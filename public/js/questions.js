const headElem = document.getElementById("head");
const buttonsElem = document.getElementById("buttons");
const pagesElem = document.getElementById("pages");
const voucherElem = document.getElementById("voucher");


//Класс, который представляет сам тест
class Quiz
{
	constructor(type, questions, results)
	{
		//Тип теста: 1 - классический тест с правильными ответами, 2 - тест без правильных ответов
		this.type = type;

		//Массив с вопросами
		this.questions = questions;

		//Массив с возможными результатами
		this.results = results;

		//Количество набранных очков
		this.score = 0;

		//Номер результата из массива
		this.result = 0;

		//Номер текущего вопроса
		this.current = 0;
	}

	Click(index)
	{
		//Добавляем очки
		let value = this.questions[this.current].Click(index);
		this.score += value;

		let correct = -1;

		//Если было добавлено хотя одно очко, то считаем, что ответ верный
		if(value >= 1)
		{
			correct = index;
			this.Next();
		}
		else
		{
			//Иначе ищем, какой ответ может быть правильным
			for(let i = 0; i < this.questions[this.current].answers.length; i++)
			{
				if(this.questions[this.current].answers[i].value >= 1)
				{
					correct = i;
					break;
				}
			}
		}


		return correct;
	}

	//Переход к следующему вопросу
	Next()
	{
		this.current++;

		if(this.current >= this.questions.length)
		{
			this.End();
		}
	}

	//Если вопросы кончились, этот метод проверит, какой результат получил пользователь
	End()
	{
		for(let i = 0; i < this.results.length; i++)
		{
			if(this.results[i].Check(this.score))
			{
				this.result = i;
			}
		}
	}
}

//Класс, представляющий вопрос
class Question
{
	constructor(text, answers)
	{
		this.text = text;
		this.answers = answers;
	}

	Click(index)
	{
		return this.answers[index].value;
	}
}

//Класс, представляющий ответ
class Answer
{
	constructor(text, value)
	{
		this.text = text;
		this.value = value;
	}
}

//Класс, представляющий результат
class Result
{
	constructor(text, value)
	{
		this.text = text;
		this.value = value;
	}

	//Этот метод проверяет, достаточно ли очков набрал пользователь
	Check(value)
	{
		if(this.value <= value)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

var getJSON = function(url, callback) {
	var xhr = new XMLHttpRequest();
	xhr.open('GET', url, true);
	xhr.responseType = 'json';
	xhr.onload = function() {
		var status = xhr.status;
		if (status === 200) {
			callback(null, xhr.response);
		} else {
			callback(status, xhr.response);
		}
	};
	xhr.send();
};

// // Массив с вопросами
const questions =
[
	new Question("Пройдите тест ответив правильно на вопросы",
	[
		new Answer("Начать", 1),
	])
];


getJSON(link, (err, data) => {
		if (err !== null) {
			alert('Something went wrong: ' + err);
		} else {
			data.forEach(question => {
				const answers = [];
				question.answers.forEach(answer => {
					if (answer.true == "1") {
						answer.true = 1;
					} else {
						answer.true = 0;
					}
					const answerc = new Answer(answer.title, answer.true);
					answers.push(answerc);
				});
				const quest =	new Question(question.quest, answers);
				questions.push(quest);
			});
			console.log(questions);
		}
	});

//Массив с результатами
const results =
[
	new Result("Вам многому нужно научиться", 0),
	new Result("Вы уже неплохо разбираетесь", 2),
	new Result("Ваш уровень выше среднего", 4),
	new Result("Вы в совершенстве знаете тему", 6)
];





//Сам тест
const quiz = new Quiz(1, questions, results);

Update();

//Обновление теста
function Update()
{
	//Проверяем, есть ли ещё вопросы
	if(quiz.current < quiz.questions.length)
	{
		//Если есть, меняем вопрос в заголовке
		headElem.innerHTML = quiz.questions[quiz.current].text;

		//Удаляем старые варианты ответов
		buttonsElem.innerHTML = "";

		//Создаём кнопки для новых вариантов ответов
		for(let i = 0; i < quiz.questions[quiz.current].answers.length; i++)
		{
			let li = document.createElement("li");
			let btn = document.createElement("a"); 
			let span = document.createElement("span");
			let p = document.createElement("p"); 
			span.className = "radio";
			
			btn.href = '#';
			// p.className = "button hovers button_normal";
			p.setAttribute("index", i);
			btn.className = "button button_normal";
			btn.setAttribute("index", i);
			p.innerHTML = quiz.questions[quiz.current].answers[i].text;
			
			btn.appendChild(span)
			btn.appendChild(p)
			li.appendChild(btn)
			buttonsElem.appendChild(li);
		}

		//Выводим номер текущего вопроса
		pagesElem.innerHTML = (quiz.current + 1);
		voucherElem.innerHTML = (quiz.score);

		//Вызываем функцию, которая прикрепит события к новым кнопкам
		Init();
	}
	else
	{
		if (quiz.score > 1) {
			$('#success').modal('show');

		} else {
			// location.assign('#')
			$('#error_q').modal('show');
		}
	}
}

function Init()
{
	//Находим все кнопки
	let btns = document.getElementsByClassName("button");

	for(let i = 0; i < btns.length; i++)
	{
		//Прикрепляем событие для каждой отдельной кнопки
		//При нажатии на кнопку будет вызываться функция Click()
		btns[i].addEventListener("click", function (e) { Click(e.target.getAttribute("index")); });
	}
}

function Click(index)
{
	//Получаем номер правильного ответа
	let correct = quiz.Click(index);

	//Находим все кнопки
	let btns = document.getElementsByClassName("button");

	//Делаем кнопки серыми
	for(let i = 0; i < btns.length; i++)
	{
		btns[i].className = "button button_passive";
	}

	//Если это тест с правильными ответами, то мы подсвечиваем правильный ответ зелёным, а неправильный - красным
	if(quiz.type == 1)
	{
		if(correct >= 0)
		{
			btns[correct].className = "button button_correct";
			btns[index].className = "button hover button_correct";

		}

		if(index != correct)
		{
			$("#error .modal-body p").html('Вы ответили не верно, попробуйте еще раз.')
			$('#error').modal('show');
		}
	}
	else
	{
		//Иначе просто подсвечиваем зелёным ответ пользователя
		btns[index].className = "button hover button_correct2";
	}

	//Ждём секунду и обновляем тест
	setTimeout(Update, 1000);
}
