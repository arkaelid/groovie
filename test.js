import http from 'k6/http';
import { check, sleep } from 'k6';

export default function () {
    let res = http.get('http://host.docker.internal/groovie/public/');
    check(res, { 'status is 200': (r) => r.status === 200 });

    let loginRes = http.post('http://host.docker.internal/groovie/public/login', { email: 'user@example.com', password: 'password' });
    check(loginRes, { 'status 200': (r) => r.status === 200 });
    sleep(1);
}


