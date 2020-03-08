pidfile = "/var/run/metronome/metronome.pid";
metronome_max_files_soft = 200000;
metronome_max_files_hard = 300000;
plugin_paths = {
        "/usr/lib/metronome/isp-modules",
};
use_libevent = true;
log = {
        debug = "/var/log/metronome/metronome.dbg",
        info = "/var/log/metronome/metronome.log",
        error = "/var/log/metronome/metronome.err",
};
use_ipv6 = true;
http_ports = {
        5290,
};
https_ports = {
        5291,
};
pastebin_ports = {
        5292,
};
bosh_ports = {
        5280,
};
admins = {
        
};
modules_enabled = {
        "saslauth",
        "tls",
        "dialback",
        "disco",
        "discoitems",
        "version",
        "uptime",
        "time",
        "ping",
        "admin_adhoc",
        "admin_telnet",
        "bosh",
        "posix",
        "announce",
        "offline",
        "webpresence",
        "mam",
        "stream_management",
        "message_carbons"
};
modules_disabled = {
};
bosh_max_inactivity = 30;
consider_bosh_secure = true;
cross_domain_bosh = true;
allow_registration = false;
ssl = {
        key = "/etc/metronome/certs/localhost.key",
        certificate = "/etc/metronome/certs/localhost.cert",
};
c2s_require_encryption = false;
s2s_secure = true;
s2s_insecure_domains = {
        "gmail.com",
};
authentication = "internal_plain";
