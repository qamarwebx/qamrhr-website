google.maps.__gjsload__('search_impl', function(_) {
    var Rjb = function(a, b) {
            _.H(a.Ig, 3, b)
        },
        Vjb = function(a, b, c) {
            const d = _.qL(new Sjb);
            c.vq = (0, _.Ca)(d.load, d);
            c.clickable = 0 != a.get("clickable");
            _.rMa(c, _.GR(b));
            const e = [];
            e.push(_.jk(c, "click", (0, _.Ca)(Tjb, null, a)));
            _.Qb(["mouseover", "mouseout", "mousemove"], function(f) {
                e.push(_.jk(c, f, (0, _.Ca)(Ujb, null, a, f)))
            });
            e.push(_.jk(a, "clickable_changed", function() {
                a.Fg.clickable = 0 != a.get("clickable")
            }));
            a.Gg = e
        },
        Tjb = function(a, b, c, d, e) {
            let f = null;
            if (e && (f = {
                    status: e.getStatus()
                }, 0 == e.getStatus())) {
                f.location = _.X(e.Ig,
                    2) ? new _.xj(_.tu(_.J(e.Ig, 2, _.zu).Ig, 1), _.tu(_.J(e.Ig, 2, _.zu).Ig, 2)) : null;
                f.fields = {};
                const g = _.li(e.Ig, 3);
                for (let h = 0; h < g; ++h) {
                    const l = _.Ur(e.Ig, 3, _.PR, h);
                    f.fields[l.getKey()] = l.getValue()
                }
            }
            _.wk(a, "click", b, c, d, f)
        },
        Ujb = function(a, b, c, d, e, f, g) {
            let h = null;
            f && (h = {
                title: f[1].title,
                snippet: f[1].snippet
            });
            _.wk(a, b, c, d, e, h, g)
        },
        Wjb = function() {},
        Xjb = class extends _.R {
            constructor() {
                super()
            }
            Zi() {
                return _.Ji(this.Ig, 2)
            }
        },
        Yjb = [_.K, , , _.Sp, _.yNa];
    var Zjb = class extends _.R {
        constructor(a) {
            super(a)
        }
        getStatus() {
            return _.I(this.Ig, 1, -1)
        }
    };
    var Sjb = class {
        constructor() {
            var a = _.Io,
                b = _.Fo;
            this.Gg = _.Li;
            this.Fg = _.Or(_.Gz, a, _.qB + "/maps/api/js/LayersService.GetFeature", b)
        }
        load(a, b) {
            function c(g) {
                g = new Zjb(g);
                b(g)
            }
            var d = new Xjb;
            _.H(d.Ig, 1, a.layerId.split("|")[0]);
            _.H(d.Ig, 2, a.featureId);
            Rjb(d, this.Gg.Fg().Fg());
            for (var e in a.parameters) {
                var f = _.Fi(d.Ig, 4, _.PR);
                _.H(f.Ig, 1, e);
                _.H(f.Ig, 2, a.parameters[e])
            }
            a = _.si(d.zi(), Yjb, 1);
            this.Fg(a, c, c);
            return a
        }
        cancel() {
            throw Error("Not implemented");
        }
    };
    Wjb.prototype.xD = function(a) {
        if (_.fn[15]) {
            var b = a.Jg;
            const c = a.Jg = a.getMap();
            b && a.Fg && (a.Hg ? (b = b.__gm.Vj, b.set(b.get().qn(a.Fg))) : a.Fg && _.OMa(a.Fg, b) && (_.Qb(a.Gg || [], _.lk), a.Gg = null));
            if (c) {
                b = new _.wy;
                const d = a.get("layerId").split("|");
                b.layerId = d[0];
                for (let e = 1; e < d.length; ++e) {
                    const [f, ...g] = d[e].split(":");
                    b.parameters[f] = g.join(":")
                }
                a.get("spotlightDescription") && (b.spotlightDescription = new _.Vy(a.get("spotlightDescription")));
                a.get("paintExperimentIds") && (b.paintExperimentIds = a.get("paintExperimentIds").slice(0));
                a.get("styler") && (b.styler = new _.Ky(a.get("styler")));
                a.get("roadmapStyler") && (b.roadmapStyler = new _.Ky(a.get("roadmapStyler")));
                a.get("travelMapRequest") && (b.travelMapRequest = new _.Rha(a.get("travelMapRequest")));
                a.get("mapsApiLayer") && (b.mapsApiLayer = new _.Cy(a.get("mapsApiLayer")));
                a.get("mapFeatures") && (b.mapFeatures = a.get("mapFeatures"));
                a.get("clickableCities") && (b.clickableCities = a.get("clickableCities"));
                a.get("searchPipeMetadata") && (b.searchPipeMetadata = new _.bB(a.get("searchPipeMetadata")));
                a.get("overlayLayer") && (b.overlayLayer = new _.Wy(a.get("overlayLayer")));
                a.get("caseExperimentIds") && (b.caseExperimentIds = a.get("caseExperimentIds").slice(0));
                a.get("boostMapExperimentIds") && (b.boostMapExperimentIds = a.get("boostMapExperimentIds").slice(0));
                a.get("airQualityPipeMetadata") && (b.airQualityPipeMetadata = new _.wha(a.get("airQualityPipeMetadata")));
                a.get("directionsPipeParameters") && (b.directionsPipeParameters = new _.uha(a.get("directionsPipeParameters")));
                a.get("clientSignalPipeMetadata") &&
                    (b.clientSignalPipeMetadata = new _.PA(a.get("clientSignalPipeMetadata")));
                b.darkLaunch = !!a.get("darkLaunch");
                a.Fg = b;
                a.Hg = a.get("renderOnBaseMap");
                a.Hg ? (a = c.__gm.Vj, a.set(a.get().Bl(b))) : Vjb(a, c, b);
                _.ql(c, "Lg");
                _.ol(c, 148282)
            }
        }
    };
    _.bk("search_impl", new Wjb);
});