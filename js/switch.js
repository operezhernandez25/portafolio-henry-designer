$('.switch').each(function() {

    let toggle = $(this),
        input = toggle.children('input'),
        $canvas = toggle.find('canvas'),
        canvas = $canvas[0],
        renderer = new THREE.WebGLRenderer({
            canvas: canvas,
            context: canvas.getContext('webgl2'),
            antialias: true,
            alpha: true
        });

    renderer.setSize(40, 40);
    renderer.setPixelRatio(window.devicePixelRatio ? window.devicePixelRatio * 2 : 2);

    renderer.shadowMap.enabled = true;

    let scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(45, $canvas.width() / $canvas.height(), 0.1, 1000);

    camera.position.z = 92;

    let shape = new THREE.CylinderGeometry(16, 16, 8, 20);
    let material = new THREE.MeshPhongMaterial({
        color: 0xE4ECFA,
        shininess: 20,
        opacity: .96,
        transparent: true
    });
    let donut = new THREE.Mesh(shape, material);

    scene.add(donut);

    let lightTop = new THREE.DirectionalLight(0xFFFFFF, .6);
    lightTop.position.set(0, 60, 60);
    lightTop.castShadow = true;
    scene.add(lightTop);

    let right = new THREE.DirectionalLight(0xFFFFFF, .5);
    right.position.set(20, 20, 40);
    right.castShadow = true;
    scene.add(right);

    let left = new THREE.DirectionalLight(0xFFFFFF, .5);
    left.position.set(-20, 20, 40);
    left.castShadow = true;
    scene.add(left);

    let active = new THREE.DirectionalLight(0x275EFE, .8);
    active.position.set(0, -80, 20);
    active.castShadow = true;
    scene.add(active);

    scene.add(new THREE.AmbientLight(0x6C7486));

    var render = function() {

        requestAnimationFrame(render);

        TweenMax.render();

        renderer.render(scene, camera);
        
    };

    render();

    input.on('change', e => {
        let checked = input.is(':checked'),
            z = !checked ? THREE.Math.degToRad(0) : THREE.Math.degToRad(90),
            x = !checked ? THREE.Math.degToRad(90) : THREE.Math.degToRad(0);
        TweenMax.to(donut.rotation, 3, {
            ease: Elastic.easeOut.config(!checked ? 1.16 : 1.04, !checked ? .32 : .36),
            z: z,
            x: x
        });
        active.intensity = !checked ? .4 : .8;
        active.color.setHex(!checked ? 0xFFFFFF : 0x275EFE);
    }).trigger('change');

});





$(".mamalon-checkbox").change(function(){
    let this_test = $(this);
    
    setTimeout(function () {
            $("#"+$(this_test).data("modal")).modal("toggle");
            
        }, 1000);
    })