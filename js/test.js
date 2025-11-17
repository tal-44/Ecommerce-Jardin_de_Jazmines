const Controller = {
    moveTo(x, y) {
        this.nodes[0].updateRelative(true, true);
        let dist = Math.hypot(x - this.end.x, y - this.end.y);
        let len = Math.max(dist - this.speed, 0);
        for (let i = this.nodes.length - 1; i >= 0; i--) {
            let node = this.nodes[i];
            let ang = Math.atan2(node.y - y, node.x - x);
            node.x -= Math.cos(ang) * len;
            node.y -= Math.sin(ang) * len;
            x = node.x; y = node.y; len = node.size;
        }
    },
    update() {
        this.moveTo(Input.mouse.x, Input.mouse.y);
    }
};