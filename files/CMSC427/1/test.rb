function Utility(utilityName, utilityDescription) {
	this.utilityName = utilityName;
	this.utilityDescription = utilityDescription;

	this.info = function(){
		document.writeln("Utility Name: " + this.utilityName + "<br>");
		document.writeln("Utility Description: " + this.utilityDescription + "<br>");	
	}
}



function PhotoViewer() {
	Utility.call(this,"Photo Viewer", "A slide show of selected images.");
	this.dll = new DoublyLinkedList(null);

	this.getArrayPhotosNames = function () {
		this.dll = new DoublyLinkedList(null);
		let folder = document.getElementById("folder").value;
		let name = document.getElementById("imgName").value;
		let start = document.getElementById("start").value;
		let end = document.getElementById("end").value;
		let error = document.getElementById("error");

		if (isNaN(start) || isNaN(end) || end < start) {
			error.innerHTML = "Invalid Range";
			return false;
		}

		for (let i = start; i <= end; i++) {
			this.dll.add(folder+name+i+".jpg");
		}

		return true;
	}

	this.randomize = function() {
		this.dll.shuffle();
	}
}


PhotoViewer.prototype = Object.create(Utility.prototype);
PhotoViewer.prototype.constructor = PhotoViewer;


//PHOTO VIEWER APPLICATION LOGIC
let $photoViewer = new PhotoViewer();
let $pos = null;
let timer1;

function loadImages() {
	document.getElementById("error").innerHTML = "";
	$pos = null;
	if($photoViewer.getArrayPhotosNames()) {
		next();
		return true;
	}

	return false;
}

function next() {

	if($pos == null || $pos.next == null) {
		$pos = $photoViewer.dll.head;
	} else {
		$pos = $pos.next;
	}

	//Assign Image Tag
	let img = document.getElementById("image");
	img.src = $pos.value;
}

function previous() {

	if($pos.previous == null) {
		$pos = $photoViewer.dll.tail;
	} else {
		$pos = $pos.previous;
	}

	//Assign Image Tag
	let img = document.getElementById("image");
	img.src = $pos.value;
}

function random() {
	if (loadImages()) {
		$photoViewer.randomize();
		next();
		return true;
	}

	return false;
}

function autoSlideShow(){
	if (loadImages()) {
		timer1 = setInterval(next, 1000);
	}
	
}

function autoRandomSlideShow() {
	if(random()) {
		timer1 = setInterval(next, 1000);
	} 
}


function Recorder() {
	Utility.call(this,"Drawing Recorder", "Record and play the activity associated with the drawing application");
	
	this.recordings = [];
	this.dll = new DoublyLinkedList(null);
	this.isRecording = false;
	this.color = "#ff0000";
	this.sideLength = 10;
	this.pos = undefined;
	let timer;
	
	this.startRecording = function() {
		this.isRecording = true;
		alert("Started Recording!");
	}

	this.stopRecording = function() {
		this.isRecording = false;
		alert("Stopped Recoring");
	}

	this.play = function() {
		
		if (this.isRecording) {
			alert("Please stop the recording before playing.");
			return false;
		} else if (this.dll.isEmpty()) {
			alert("Nothing recorded yet.");
			return false;
		}
		
		timer = setInterval(nextPoint, 10);
	}

	
	this.saveRecording = function() {
		let name = prompt("What is name would you like to save the recording under?");
		if (name == null) {
			alert("You need to give a name to save a recording.");
			return false;
		}
		this.recordings.push(name);
		localStorage.setItem(name,toJSON());	
	}
	

	this.getRecording = function() {
		let name = prompt("What is name of the recording you want?\n" + JSON.stringify(this.recordings));
		if (name == null) {
			alert("You need to provide a name for me to find a recording.");
			return false;
		}
		this.clear();
		let str = localStorage.getItem(name);
		this.dll = toDLL(str);
		this.play();
	}

	this.clear = function() {
		let context = document.getElementById("canvas").getContext("2d");
		context.fillStyle = "white";
		context.fillRect(0, 0, 800, 600);
		//Should reset the doubly linked list.
		this.dll = new DoublyLinkedList(null);
	}
	
	this.increase = function() {
		this.sideLength++;
	}
	
	this.decrease = function() {
		this.sideLength--;
	}
	
	//Change the color by geting the value from the input color tag
	this.changeColor = function changeColor() {
		let colorBtn = document.getElementById("color");
		this.color = colorBtn.value;
	}
	//Draw a point in the canvas
	this.draw = function(xPos, yPos){
		let context = document.getElementById("canvas").getContext("2d");
		
		if(this.isRecording) {
			this.dll.add({x: xPos, y: yPos, color: this.color, length: this.sideLength});
		}
		
		context.fillStyle = this.color;
		context.fillRect(xPos, yPos, this.sideLength, this.sideLength);
	}
	
	
	
	//Private function to convert to JSON.
	function toJSON() {
		let array = [];
		let curr = $recorder.dll.head;

		while(curr != null) {
			array.push(curr.value);
			curr = curr.next;
		}

		return JSON.stringify(array);
	}
	
	//Private function to convert to doubly linked list.
	function toDLL(str) {
		let array = JSON.parse(str);
		let newDLL = new DoublyLinkedList(null);

		for(let i = 0; i < array.length;i++) {
			newDLL.add(array[i]);
		}

		return newDLL;
	}
	
	//Private function Advances the point and draws it.
	function nextPoint () {
	
		if(this.pos === undefined) {
			this.pos = $recorder.dll.head;
			//CLEAR THE CANVAS
			let context = document.getElementById("canvas").getContext("2d");
			context.fillStyle = "white";
			context.fillRect(0, 0, 800, 600);
			
		} else {
			this.pos = pos.next;	
		}
	
		if (this.pos === null) {
			console.log(timer);
			clearInterval(timer);
			this.pos = undefined;
			return false;
		}
		
		let context1 = document.getElementById("canvas").getContext("2d");
		context1.fillStyle = this.pos.value.color;
		context1.fillRect(this.pos.value.x, this.pos.value.y, this.pos.value.length,  this.pos.value.length);
	}
	

	
}

Recorder.prototype = Object.create(Utility.prototype);
Recorder.prototype.constructor = Recorder;

//DRAWING APP LOGIC
let $recorder = new Recorder();
function processMousePosition(event) {
	$recorder.draw(event.pageX, event.pageY);
}

function drawWrapper(event) {
	processMousePosition(event);
	let canvas = document.getElementById("canvas");
	canvas.onmousemove = processMousePosition;
	canvas.onmouseup = function(){
		canvas.onmousemove = "";
	}
}







 











