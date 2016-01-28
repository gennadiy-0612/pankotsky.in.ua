"use strict";
/**
 * Created by Gehh on 01.04.2015.
 */
var AFG = {
    papa: 'album',
    son: 'p',
    selector: 'id',
    name: 'mini-frame',
    makeNode: function () {
        AFG[AFG.name] = document.createElement(AFG.son);
        AFG[AFG.name].setAttribute('id', AFG.name);
        AFG[AFG.name] = document.getElementById(AFG.papa).appendChild(AFG[AFG.name]);
    }
};

if (window.location.hash !== '') {
    AFG.hash = parseInt(window.location.hash.match(/\d/)[0]);
    AFG.urlEnd = document.getElementsByClassName('hrefer')[AFG.hash].getAttribute('href');

}
else {
    AFG.hash = '0';
    AFG.urlEnd = document.getElementsByClassName('hrefer')[0].getAttribute('href');
    window.location.hash = '#' + AFG.hash + '-' + AFG.urlEnd;
}

AFG.EV = {
    ev: '',
    fn: '',
    elem: '',
    add: function () {
        if (window.addEventListener) {
            this.elem.addEventListener(this.ev, this.fn, false);
        } else if (window.attachEvent) {
            this.elem.attachEvent("on" + this.ev, this.fn);
        }
    },
    out: function () {
        if (window.removeEventListener) {
            this.elem.removeEventListener(this.ev, this.fn, false);
        } else if (window.detachEvent) {
            this.elem.detachEvent("on" + this.ev, this.fn);
        }
    }
};

AFG.moveGoods = {
    frame: document.getElementsByClassName('fotonote'),
    Length: document.getElementsByClassName('fotonote').length,
    li: document.getElementsByClassName('li'),
    i: 0,
    Target: function () {
        AFG.hash = this.getAttribute('href').match(/\d/)[0];
    },
    do: function () {
        for (this.i = 0; this.i < this.Length; ++this.i) {
            this.frame[this.i].setAttribute('id', '');
            this.li[this.i].firstChild.setAttribute('class', 'not-active-a');
        }
        this.frame[AFG.hash].setAttribute('id', 'album');
        this.li[AFG.hash].firstChild.setAttribute('class', 'active-a');
    },
    passThis: function () {
        AFG.moveGoods.do.call(AFG.moveGoods);
    }
};

AFG.papa = 'fotonote';
AFG.son = 'ul';
AFG.name = 'ulNavy';
AFG.makeNode();

AFG.liA = {
    i: '',
    setId: function () {
        for (this.i = 0; i < AFG.moveGoods.frame.length; ++this.i) {
            AFG.papa = 'ulNavy';
            AFG.son = 'li';
            AFG.name = AFG.son + 'Navy' + i;
            AFG.makeNode();
            AFG[AFG.son + 'Navy' + i].setAttribute('class', 'li');
            AFG.papa = AFG.son + 'Navy' + i;
            AFG.son = 'a';
            AFG.name = 'aNavy' + i;
            AFG.makeNode();
            AFG.EV.ev = 'click';
            AFG.EV.fn = AFG.moveGoods.Target;
            AFG.EV.elem = AFG[AFG.name];
            AFG.EV.add();
            AFG.EV.ev = 'click';
            AFG.EV.fn = AFG.moveGoods.passThis;
            AFG.EV.elem = AFG[AFG.name];
            AFG.EV.add();
            AFG[AFG.name].textContent = AFG[AFG.name].innerHTML = i;
            AFG.urlEnd = document.getElementsByClassName('hrefer')[i].getAttribute('href');
            AFG[AFG.name].setAttribute('href', '#' + i + '-' + AFG.urlEnd);
            AFG[AFG.name].setAttribute('class', 'not-active-a');
        }
        AFG['aNavy' + parseInt(AFG.hash)].setAttribute('class', 'active-a');
        document.getElementsByClassName('fotonote')[parseInt(AFG.hash)].setAttribute('id', 'album');
        document.getElementById('fotonote').setAttribute('id', 'album-note');
    }
};

AFG.image = function () {
    this.setAttribute('id', 'show');

};

AFG.listImg = {
    i: '',
    IMG: '',
    iter: function () {
        for (this.i = 0; this.i < AFG.moveGoods.frame.length; this.i++) {
            this.IMG = document.getElementsByClassName('polimage')[this.i];
            AFG.image.el = this.IMG;
            AFG.EV.ev = 'load';
            AFG.EV.fn = AFG.image;
            AFG.EV.elem = this.IMG;
            AFG.EV.add();
        }
    }
};

AFG.listImg.iter();

AFG.zoom = {
    body: document.getElementById('body'),
    frame: document.getElementsByClassName('link')[AFG.hash],
    aHref: document.getElementsByClassName('link'),
    ImgSrc: document.getElementsByClassName('polimage')[AFG.hash].getAttribute('src'),
    PolarImg: document.getElementsByClassName('polimage')[AFG.hash],
    hideBalls: document.getElementById('ulNavy'),
    prevDef: function (evt) {
        evt.preventDefault();
    },
    do: function () {
        this.PolarImg.setAttribute('id', 'hide');
        if (this.frame.getAttribute('id') == 'full') {
            this.body.setAttribute('style','overflow: auto;');
            this.frame.setAttribute('id', '');
            this.hideBalls.setAttribute('id', 'ulNavy');
            this.PolarImg.setAttribute('src', this.ImgSrc);
        } else {
            this.body.setAttribute('style','overflow: hidden;');
            this.frame.setAttribute('id', 'full');
            this.hideBalls.setAttribute('id', 'hide');
            this.PolarImg.setAttribute('src', this.aHref[AFG.hash].getAttribute('href'));
        }
    },
    passThis: function () {
        AFG.zoom.do.call(AFG.zoom)
    }
};

for (AFG.zoom.i = 0; AFG.zoom.i < AFG.moveGoods.Length; AFG.zoom.i++) {
    AFG.EV.ev = 'click';
    AFG.EV.fn = AFG.zoom.prevDef;
    AFG.EV.elem = document.getElementsByClassName('link')[AFG.zoom.i];
    AFG.EV.add();
    AFG.EV.fn = AFG.zoom.passThis;
    AFG.EV.add();
}

if (window.addEventListener) window.addEventListener('load', AFG.liA.setId, false);
else window.attachEvent('onload', AFG.liA.setId);