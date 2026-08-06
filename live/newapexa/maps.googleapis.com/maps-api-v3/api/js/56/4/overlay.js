google.maps.__gjsload__('overlay', function(_) {
    var JD = function(a) {
            this.Fg = a
        },
        Kma = function() {},
        KD = function(a) {
            a.Sx = a.Sx || new Kma;
            return a.Sx
        },
        Lma = function(a) {
            this.Eh = new _.Qm(() => {
                const b = a.Sx;
                if (a.getPanes()) {
                    if (a.getProjection()) {
                        if (!b.ow && a.onAdd) a.onAdd();
                        b.ow = !0;
                        a.draw()
                    }
                } else {
                    if (b.ow)
                        if (a.onRemove) a.onRemove();
                        else a.remove();
                    b.ow = !1
                }
            }, 0)
        },
        Mma = function(a, b) {
            const c = KD(a);
            let d = c.yv;
            d || (d = c.yv = new Lma(a));
            _.Qb(c.Rh || [], _.lk);
            var e = c.li = c.li || new _.oia;
            const f = b.__gm;
            e.bindTo("zoom", f);
            e.bindTo("offset", f);
            e.bindTo("center", f, "projectionCenterQ");
            e.bindTo("projection", b);
            e.bindTo("projectionTopLeft", f);
            e = c.GB = c.GB || new JD(e);
            e.bindTo("zoom", f);
            e.bindTo("offset", f);
            e.bindTo("projection", b);
            e.bindTo("projectionTopLeft", f);
            a.bindTo("projection", e, "outProjection");
            a.bindTo("panes", f);
            e = () => _.Rm(d.Eh);
            c.Rh = [_.jk(a, "panes_changed", e), _.jk(f, "zoom_changed", e), _.jk(f, "offset_changed", e), _.jk(b, "projection_changed", e), _.jk(f, "projectioncenterq_changed", e)];
            _.Rm(d.Eh);
            b instanceof _.Gk ? (_.ql(b, "Ox"), _.ol(b, 148440)) : b instanceof _.Ml && (_.ql(b, "Oxs"),
                _.ol(b, 181451))
        },
        Rma = function(a) {
            if (a) {
                var b = a.getMap();
                if (Nma(a) !== b && b && b instanceof _.Gk) {
                    const c = b.__gm;
                    c.overlayLayer ? a.__gmop = new Oma(b, a, c.overlayLayer) : c.Gg.then(({
                        lh: d
                    }) => {
                        const e = new Pma(b, d);
                        d.Ai(e);
                        c.overlayLayer = e;
                        Qma(a);
                        Rma(a)
                    })
                }
            }
        },
        Qma = function(a) {
            if (a) {
                var b = a.__gmop;
                b && (a.__gmop = null, b.Fg.unbindAll(), b.Fg.set("panes", null), b.Fg.set("projection", null), b.Hg.rl(b), b.Gg && (b.Gg = !1, b.Fg.onRemove ? b.Fg.onRemove() : b.Fg.remove()))
            }
        },
        Nma = function(a) {
            return (a = a.__gmop) ? a.map : null
        },
        Sma = function(a,
            b) {
            a.Fg.get("projection") != b && (a.Fg.bindTo("panes", a.map.__gm), a.Fg.set("projection", b))
        };
    _.Ia(JD, _.Ak);
    JD.prototype.changed = function(a) {
        "outProjection" != a && (a = !!(this.get("offset") && this.get("projectionTopLeft") && this.get("projection") && _.Wi(this.get("zoom"))), a == !this.get("outProjection") && this.set("outProjection", a ? this.Fg : null))
    };
    var LD = {};
    _.Ia(Lma, _.Ak);
    LD.Wk = function(a) {
        if (a) {
            var b = a.getMap();
            (KD(a).pB || null) !== b && (b && Mma(a, b), KD(a).pB = b)
        }
    };
    LD.rl = function(a) {
        const b = KD(a);
        var c = b.li;
        c && c.unbindAll();
        (c = b.GB) && c.unbindAll();
        a.unbindAll();
        a.set("panes", null);
        a.set("projection", null);
        b.Rh && _.Qb(b.Rh, _.lk);
        b.Rh = null;
        b.yv && (b.yv.Eh.Dj(), b.yv = null);
        delete KD(a).pB
    };
    var MD = {},
        Oma = class {
            constructor(a, b, c) {
                this.map = a;
                this.Fg = b;
                this.Hg = c;
                this.Gg = !1;
                _.ql(this.map, "Ox");
                _.ol(this.map, 148440);
                c.Wk(this)
            }
            draw() {
                this.Gg || (this.Gg = !0, this.Fg.onAdd && this.Fg.onAdd());
                this.Fg.draw && this.Fg.draw()
            }
        },
        Pma = class {
            constructor(a, b) {
                this.Jg = a;
                this.Hg = b;
                this.Fg = null;
                this.Gg = []
            }
            dispose() {}
            Si(a, b, c, d, e, f, g, h) {
                const l = this.Fg = this.Fg || new _.yB(this.Jg, this.Hg, () => {});
                l.Si(a, b, c, d, e, f, g, h);
                for (const n of this.Gg) Sma(n, l), n.draw()
            }
            Wk(a) {
                this.Gg.push(a);
                this.Fg && Sma(a, this.Fg);
                this.Hg.refresh()
            }
            rl(a) {
                _.Ub(this.Gg,
                    a)
            }
        };
    MD.Wk = Rma;
    MD.rl = Qma;
    _.bk("overlay", {
        Iz: function(a) {
            if (a) {
                (0, LD.rl)(a);
                (0, MD.rl)(a);
                var b = a.getMap();
                b && (b instanceof _.Gk ? (0, MD.Wk)(a) : (0, LD.Wk)(a))
            }
        },
        preventMapHitsFrom: a => {
            _.Wv(a, {
                Pk: ({
                    event: b
                }) => {
                    _.Dt(b.Kh)
                },
                Yj: b => _.Fv(b),
                Ep: b => _.Gv(b),
                Qk: b => _.Gv(b),
                lk: b => _.Hv(b)
            }).er(!0)
        },
        preventMapHitsAndGesturesFrom: a => {
            a.addEventListener("click", _.hk);
            a.addEventListener("contextmenu", _.hk);
            a.addEventListener("dblclick", _.hk);
            a.addEventListener("mousedown", _.hk);
            a.addEventListener("mousemove", _.hk);
            a.addEventListener("MSPointerDown",
                _.hk);
            a.addEventListener("pointerdown", _.hk);
            a.addEventListener("touchstart", _.hk);
            a.addEventListener("wheel", _.hk)
        }
    });
});