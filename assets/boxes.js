let boxes = [];
let boxCount = 2;

let astaImg;

function preload() {
    astaImg = loadImage('wp-content/themes/hfk-asta/assets/logo_asta_rot.png');
}

function setup() {
    let parentCanvas = document.getElementById('site-content');
    let parentWidth = parentCanvas.offsetWidth;
    let parentHeight = parentCanvas.offsetHeight;

    createCanvas(parentWidth, parentHeight);

    for (let i = 0; i < boxCount; i++) {
        boxes.push(new box([random(0, width), random(0, height)], random(40, 120), random(40, 120), random(0, TWO_PI), 0));
    }

    boxes.push(new box([random(0, width), random(0, height)], 295 / 2, 168 / 2, random(0, TWO_PI), 1));
}

function draw() {
    background(255);

    for (let i = 0; i < boxes.length; i++) {
        boxes[i].draw();
    }

    for (let i = 0; i < boxes.length; i++) {
        boxes[i].collide();
    }

    for (let i = 0; i < boxes.length; i++) {
        boxes[i].drag();
    }
}

class box {
    constructor(_pos, _width, _height, _rotation, _state) {
        this.pos = createVector(_pos[0], _pos[1]);
        this.width = _width;
        this.height = _height;
        this.rotation = _rotation;

        this.corners = [];
        this.hoverCorners = [];

        this.state = _state;

        this.collidingWBox = false;

        this.updateCorners();

        this.speed = 0;
        this.direction = createVector(0, 0);
        this.velocity = createVector(0, 0);
    }

    draw() {
        push();
        translate(this.pos.x, this.pos.y);
        rotate(this.rotation);

        if (this.state == 0) {
            rectMode(CENTER);
            fill('#d50e31');
            noStroke();
            rect(0, 0, this.width, this.height);
        } else if (this.state == 1) {
            imageMode(CENTER);
            image(astaImg, 0, 0, this.width, this.height);
        }


        // Debug Draw
        /*
        strokeWeight(1);
        stroke(0);
        line(0, 0, 20, 0);
        */

        pop();

        /*
        noStroke();
        ellipseMode(CENTER);

        for (let i = 0; i < this.corners.length; i++) {
            fill(0);
            ellipse(this.corners[i].x, this.corners[i].y, 2, 2);
            ellipse(this.hoverCorners[i].x, this.hoverCorners[i].y, 4, 4);
        };
        */

        this.hover();
    }

    hover() {
        if (collidePointPoly(mouseX, mouseY, this.corners)) {
            return true;
        } else {
            return false;
        }
    }

    drag() {
        if (!this.collidingWBox) {
            if (collidePointPoly(mouseX, mouseY, this.hoverCorners)) {
                // Set new Position
                this.direction.set(mouseX - this.pos.x, mouseY - this.pos.y);
                let mousePos = createVector(mouseX, mouseY);
                dist = this.pos.dist(mousePos);

                this.velocity.set(this.direction.x, this.direction.y);
                this.velocity.setMag(dist / 10);

                this.pos.set(this.pos.x + this.velocity.x, this.pos.y + this.velocity.y);

                // Set Rotation Angle
                let originVector = createVector(1, 0);
                originVector.rotate(this.rotation);
                let angle = this.direction.angleBetween(originVector);

                // Debug Draw
                /*
                stroke(0);
                strokeWeight(1);
                line(this.pos.x, this.pos.y, this.pos.x + this.direction.x, this.pos.y + this.direction.y);
                */

                if (abs(degrees(angle)) > 5) {
                    this.rotation -= angle / 10;
                }

                this.updateCorners();
            } else if (mag(this.velocity.x, this.velocity.y) > .4) {
                this.pos.set(this.pos.x + this.velocity.x, this.pos.y + this.velocity.y);

                this.velocity.setMag(mag(this.velocity.x, this.velocity.y) * .8);

                this.updateCorners();
            }
        }
    }

    collide() {
        this.collidingWBox = false;

        for (let i = 0; i < boxes.length; i++) {
            if (this != boxes[i]) {
                if (collidePolyPoly(this.corners, boxes[i].corners, true)) {
                    let dir = createVector(this.pos.x - boxes[i].pos.x, this.pos.y - boxes[i].pos.y);
                    dir.setMag(mag(dir.x, dir.y) / 10);

                    this.pos.set(this.pos.x + dir.x, this.pos.y + dir.y);

                    this.updateCorners();

                    this.collidingWBox = true;
                }
            }
        }
    }

    updateCorners() {
        this.corners[0] = createVector(this.pos.x - this.width / 2, this.pos.y - this.height / 2);
        this.corners[1] = createVector(this.pos.x + this.width / 2, this.pos.y - this.height / 2);
        this.corners[2] = createVector(this.pos.x + this.width / 2, this.pos.y + this.height / 2);
        this.corners[3] = createVector(this.pos.x - this.width / 2, this.pos.y + this.height / 2);

        this.hoverCorners[0] = createVector(this.pos.x - this.width, this.pos.y - this.height);
        this.hoverCorners[1] = createVector(this.pos.x + this.width, this.pos.y - this.height);
        this.hoverCorners[2] = createVector(this.pos.x + this.width, this.pos.y + this.height);
        this.hoverCorners[3] = createVector(this.pos.x - this.width, this.pos.y + this.height);

        for (let i = 0; i < this.corners.length; i++) {
            this.corners[i].set(rotateAroundPoint(this.corners[i], this.pos, this.rotation));
            this.hoverCorners[i].set(rotateAroundPoint(this.hoverCorners[i], this.pos, this.rotation));
        }
    }
}

function rotateAroundPoint(_point, _origin, _angle) {
    let tmpPoint = createVector(_point.x, _point.y);
    let origin = createVector(_origin.x, _origin.y);

    let s = sin(_angle);
    let c = cos(_angle);

    tmpPoint.set(tmpPoint.x - origin.x, tmpPoint.y - origin.y);

    let newPoint = createVector(tmpPoint.x * c - tmpPoint.y * s, tmpPoint.x * s + tmpPoint.y * c);

    newPoint.set(newPoint.x + origin.x, newPoint.y + origin.y);

    return newPoint;
}

function mouseClicked() {

}